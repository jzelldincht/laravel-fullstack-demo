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

namespace Modules\Api\Http\Controllers\v1\Admin;

use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Requests\Admin\ChangePasswordRequest;
use Modules\Api\Http\Requests\Admin\LoginRequest;
use Modules\Api\Services\Admin\AuthService;
use Modules\Api\Services\Admin\TokenService;

class AuthController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 登录
     */
    public function login(LoginRequest $request)
    {
        return AuthService::getInstance()->login($request->only([
            'username', 'password',
        ]));
    }

    /**
     * 刷新token
     * @return \Modules\Common\Base\JSON
     */
    public function refreshToken()
    {
        return TokenService::getInstance()->refreshToken();
    }

    /***
     * 获取 管理员用户信息
     * @return \Modules\Common\Base\JSON
     */
    public function adminInformation()
    {
        return AuthService::getInstance()->adminInfo();
    }

    /**
     * 管理员登出
     * @return mixed
     */
    public function logout()
    {
        return AuthService::getInstance()->logout();
    }

    /**
     * 修改密码
     */
    public function changePassword(ChangePasswordRequest $request){

        return AuthService::getInstance()->changePassword($request->only([
            'new_password', 'old_password',
        ]));
    }
}
