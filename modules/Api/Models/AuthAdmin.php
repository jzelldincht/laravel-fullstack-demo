<?php

namespace Modules\Api\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Api\Services\ApiService;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
