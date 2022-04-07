<?php

namespace Modules\Api\Services\Admin;

use Modules\Api\Exceptions\ApiException;
use Modules\Api\Models\Admin\AuthAdmin;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService extends ApiService
{
    public static $_user=null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @name | 管理员登录
     * @param array $credentials 用户登录输入信息
     * @param string data.username 管理员用户名
     * @param string data.password 管理员密码
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     */
    public function login(array $credentials)
    {
        // 验证是否数据是否OK 验证用户名密码
        $token = auth()->attempt($credentials);//会生成一个jwt token
        if($token) {
            self::$_user = auth()->user()->toArray();

            // 缓存一下
            ToolService::getInstance()->saveCache(config('api.cacheKeys.adminInfo').self::$_user['id'], json_encode(self::$_user));

            return $this->success(ResponseMessage::OK, TokenService::getInstance()->responseWithToken($token));
        }

        $this->fail(ResponseMessage::INVALID_USERNAME_OR_PASSWORD, ResponseStatus::INVALID_USERNAME_OR_PASSWORD);
    }

    /**
     * 登出/注销登录
     */
    public function logout()
    {
        // Pass true as the first param to force the token to be blacklisted "forever".
        auth()->invalidate(true);

        return $this->success(ResponseMessage::OK, []);
    }

    /**
     * 获取管理员信息
     * @throws JWTException
     */
    public function adminInfo(): \Illuminate\Http\JsonResponse
    {
        $admin = auth()->user()->toArray();
        return $this->success(ResponseMessage::OK, $admin);
    }

    /**
     * 修改管理员密码
     * @param null $data
     * @return \Illuminate\Http\JsonResponse|void
     * @throws ApiException
     * @throws JWTException
     */
    public function changePassword($credentials = null) {
        $user_info = auth()->user()->toArray();

        // 验证是否数据是否OK 验证用户名密码
        if(auth()->attempt([
            'username' => $user_info['username'],
            'password' => $credentials['old_password'],
        ])) {
            // 修改密码
            if(AuthAdmin::where('username', $user_info['username'])->update(['password' => bcrypt($credentials['new_password'])])) {
                return $this->success(ResponseMessage::OK, []);
            }

            // 修改密码失败
            $this->fail(ResponseMessage::UPDATE_API_ERROR, ResponseStatus::UPDATE_API_ERROR);
        }

        $this->fail(ResponseMessage::INVALID_OLD_PASSWORD, ResponseStatus::INVALID_OLD_PASSWORD);
    }
}
