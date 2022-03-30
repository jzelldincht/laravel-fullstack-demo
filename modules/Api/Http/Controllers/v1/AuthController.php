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
 * @date 2022/3/9 10:17
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Controllers\v1;

use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Requests\LoginRequest;
use Modules\Api\Services\AuthService;
use Modules\Api\Services\TokenService;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends ApiController
{
    /**
     * 登录
     */
    public function login(LoginRequest $request)
    {
        return (new AuthService())->login($request->only([
            'username', 'password',
        ]));
    }

    /**
     * 刷新token
     * @return \Modules\Common\Base\JSON
     * @throws \Modules\Api\Exceptions\ApiException
     */
    public function refreshToken()
    {
        return (new TokenService())->refreshToken();
    }


    public function adminInfo()
    {
        return  (new AuthService())->adminInfo();
    }
}
