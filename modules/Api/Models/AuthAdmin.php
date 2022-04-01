<?php

namespace Modules\Api\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * 权限管理员模型
 * 1. 需要实现 JWTSubject 接口
 * 2. 需要继承 use Illuminate\Foundation\Auth\User
 */
class AuthAdmin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $table = 'auth_admins';
    protected $guard = 'auth';// 在 config/auth.php -> guards.auth
    protected $hidden = [// 设置模型中的隐藏字段，不需要输出 password
        'password',
    ];

    /**
     * jwt标识，即 config/jwt.php -> secret
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * jwt 自定义声明
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}
