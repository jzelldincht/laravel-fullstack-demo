<?php

namespace Modules\Api\Services\Admin;

use Modules\Api\Exceptions\ApiException;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

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
     * @param string $token 用户信息
     * @return array
     */
    public function setToken(string $token = ''): array
    {
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
            // Pass true as the first param to force the token to be blacklisted "forever".
            // The second parameter will reset the claims for the new token
            $new_token = auth()->refresh(true, true);

            return $this->success('', $this->responseWithToken($new_token));
        } catch (TokenExpiredException $e) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_EXPIRED,
                'message' => ResponseMessage::TOKEN_ERROR_EXPIRED,
            ]);
        }
        // catch (TokenBlacklistedException $e) {
        //     // 这个时候是老的token被拉黑到黑名单了
        //     throw new ApiException([
        //         'status' => ResponseStatus::TOKEN_ERROR_BLACK,
        //         'message' => ResponseMessage::TOKEN_ERROR_BLACK,
        //     ]);
        // }
        catch (JWTException $e) {
            throw new ApiException([
                'status' => ResponseStatus::TOKEN_ERROR_JWT,
                'message' => ResponseMessage::TOKEN_ERROR_JWT,
            ]);
        }
    }


}
