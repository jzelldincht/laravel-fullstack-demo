<?php

namespace Modules\Api\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Api\Exceptions\ApiException;
use Modules\Api\Http\Requests\ChangePasswordRequest;
use Modules\Api\Models\AuthAdmin;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends ApiService
{
    /**
     * @name | 管理员登录
     * @param array $data 用户登录输入信息
     * @param string data.username 管理员用户名
     * @param string data.password 管理员密码
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     */
    public function login(array $data)
    {
        // 验证是否数据是否OK 验证用户名密码
        if(true == Auth::guard('auth')->attempt($data)) {
            $admin_info = Auth::user()->toArray();
            $admin_info['password'] = $data['password'];

            return $this->apiSuccess(ResponseMessage::OK, TokenService::getInstance()->setToken($admin_info));
        }

        $this->apiError(ResponseMessage::INVALID_USERNAME_OR_PASSWORD, ResponseStatus::INVALID_USERNAME_OR_PASSWORD);
    }

    /**
     * 登出/注销登录
     */
    public function logout()
    {
        JWTAuth::parseToken()->invalidate();
        return $this->apiSuccess(ResponseMessage::OK, []);
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
     * @throws JWTException
     */
    public function adminInfo(): \Illuminate\Http\JsonResponse
    {
        $admin = $this->adminObject()->toArray();
        return $this->apiSuccess('', $admin);
    }

    /**
     * 修改管理员密码
     * @param null $data
     * @return \Illuminate\Http\JsonResponse|void
     * @throws ApiException
     * @throws JWTException
     */
    public function changePassword($data = null) {
        $user_info = $this->adminObject()->toArray();

        // 验证是否数据是否OK 验证用户名密码
        if(true == Auth::guard('auth')->attempt([
            'username' => $user_info['username'], 'password' => $data['old_password'],
            ])) {

            // 修改密码
            if(AuthAdmin::where('username', $user_info['username'])
                ->update(['password' => bcrypt($data['new_password'])])) {
                return $this->apiSuccess(ResponseMessage::OK, [], ResponseStatus::OK);
            }

            // 修改密码失败
            $this->apiError(ResponseMessage::UPDATE_API_ERROR, ResponseStatus::UPDATE_API_ERROR);
        }

        $this->apiError(ResponseMessage::INVALID_OLD_PASSWORD, ResponseStatus::INVALID_OLD_PASSWORD);
    }
}
