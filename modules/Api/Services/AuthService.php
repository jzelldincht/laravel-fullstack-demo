<?php

namespace Modules\Api\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Api\Exceptions\ApiException;
use Modules\Api\Models\AuthAdmin;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends ApiService
{
    /**
     * @name | 管理员登录
     * @param array $data 用户登录输入信息
     * @param data.username 管理员用户名
     * @param data.password 管理员密码
     * @return \Modules\Common\Base\JSON
     * @throws ApiException
     */
    public function login(array $data)
    {
        // 验证是否数据是否OK 验证用户名密码
        if(true == Auth::guard('auth')->attempt($data)) {
            $admin_info = Auth::user()->toArray();
            $admin_info['password'] = $data['password'];

            return $this->apiSuccess(ResponseMessage::OK, TokenService::getInstance()->setToken($admin_info), ResponseStatus::OK);
        }

        return $this->apiError(ResponseMessage::INVALID_USERNAME_OR_PASSWORD, ResponseStatus::INVALID_USERNAME_OR_PASSWORD);
    }

    /**
     * 登出/注销登录
     */
    public function logout()
    {
        JWTAuth::parseToken()->invalidate();
        return $this->apiSuccess(ResponseMessage::OK, [], ResponseStatus::OK);
    }

    /**
     * 用户管理员用户对象
     * @return object
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function adminObject(): object
    {
        return JWTAuth::parseToken()->toUser();
    }

    /**
     * 获取管理员信息
     */
    public function adminInfo() {
        try {
            $admin = $this->adminObject()->toArray();
            return $this->apiSuccess('', $admin);
        } catch (\Exception $e) {
            throw new ApiException(['status' => ResponseStatus::TOKEN_ERROR_JTB, 'message' => ResponseMessage::TOKEN_ERROR_JTB]);
        }
    }
}
