<?php
/**
 * + ------------------------------------------------------ +
 * | Project Name: Study Laravel Fullstack Developement     |
 * + ------------------------------------------------------ +
 * | Copyright: (c) 2022-2022 http://fullstack.test/     |
 * + ------------------------------------------------------ +
 * | License: MIT                                           |
 * + ------------------------------------------------------ +
 * | Author: Zell <jzell@qq.com>                            |
 * + ------------------------------------------------------ +
 * | Version: v1.0.0                                        |
 * + ------------------------------------------------------ +
 * @date 2022/3/9 10:33
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Api\Exceptions\ApiException;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class AuthenticateApi extends BaseMiddleware // 继承 JWTAuth 的BaseMiddleware 以使用他的方法。
{
    function __construct(\Tymon\JWTAuth\JWTAuth $auth)
    {
        parent::__construct($auth);
    }

    public function handle(Request $request, Closure $next)
    {
        // 动态设置配置文件
        config([
            'auth.defaults.guard' => 'auth',// 设置 auth.defaults.guard 权限验证方式 - config/auth.php 中 defaults.guard 部分
        ]);

        /**
         * 检验 header - X-Api-Key 是否与配置相等
         */
        if(!($api_key = $request->header(config('api.apiKeyHeaderName'), '')) || ($api_key != config('api.apiKey'))) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_KEY,
                'message' => ResponseMessage::TOKEN_ERROR_KEY,
            ]);
        }

        // 不需要提交token的路由
        $path = $request->path();
        // 检验是否在访问不用token的路由的数组中
        if(in_array($path, config('api.routesWithoutToken')))
        {
            return $next($request);
        }

        try {

            $auth_user = $this->auth->parseToken()->authenticate();

            if(!$auth_user) {
                throw new ApiException([
                    'status' => ResponseStatus::TOKEN_ERROR_SET,
                    'message' => ResponseMessage::TOKEN_ERROR_SET,
                ]);
            }
        } catch (TokenExpiredException $e) {

            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                // Auth::guard('auth')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
                return $this->setAuthenticationHeader($next($request), $token);
            }
            catch (TokenBlacklistedException $e) {
                throw new ApiException([
                    'status' => ResponseStatus::TOKEN_ERROR_EXPIRED,
                    'message' => $e->getMessage(),
                ]);
            }
            catch (JWTException $e) {// refresh ttl 时长也到期了
                throw new ApiException([
                    'status' => ResponseStatus::TOKEN_ERROR_EXPIRED,
                    'message' => $e->getMessage(),
                ]);
            }

        }
        catch (TokenBlacklistedException $e) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_BLACK,
                'message' => ResponseMessage::TOKEN_ERROR_BLACK,
            ]);
        }
        catch (TokenInvalidException | JWTException $e) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_JTB,
                'message' => ResponseMessage::TOKEN_ERROR_JTB,
            ]);
        }

        return $next($request);
    }
}
