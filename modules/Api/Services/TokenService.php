<?php

namespace Modules\Api\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Modules\Api\Exceptions\ApiException;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenService extends ApiService
{
    /**
     * 设置 token 生成机制
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 设置token
     * @param $user_data array 用户信息
     * @return array
     */
    public function setToken(array $user_data): array
    {
        if( !$token = JWTAuth::attempt($user_data) ) {
            $token = '';
        }

        return $this->responseWithToken($token);
    }

    /**
     * 组合token数据
     * @param $token
     * @return array
     */
    public function responseWithToken($token): array
    {
        return $token ? [
            'token' => $token,
            'token_type' => 'bearer',
            'expire_in' => config('jwt.ttl'),
        ] : [];
    }

    /**
     * 刷新token
     */
    public function refreshToken()
    {
        try {
            $old_token = JWTAuth::getToken();
            $new_token = JWTAuth::refresh($old_token);

            return $this->apiSuccess('', $this->responseWithToken($new_token));
        } catch (TokenBlacklistedException $e) {
            // 这个时候是老的token被拉黑到黑名单了
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_BLACK,
                'message' => ResponseMessage::TOKEN_ERROR_BLACK,
            ]);
        } catch (TokenExpiredException $e) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_EXPIRED,
                'message' => ResponseMessage::TOKEN_ERROR_EXPIRED,
            ]);
        } catch (JWTException $e) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_JWT,
                'message' => ResponseMessage::TOKEN_ERROR_JWT,
            ]);
        }
    }


}
