# auth 权限管理功能

## 如何编写
1. 编写路由
2. 编写模型，关联相关表
3. 编写控制器和方法，需要继承模块基类控制器
4. 编写请求类Request，编写验证规则，编写错误提示信息
5. 编写Service服务类，用于处理用户请求。如果有异常抛出异常；如果成功，返回成功信息

## Auth权限认证准备
1. 安装 jwt-auth 并配置，参考章节 019
2. 配置 `config/auth.php` 中的项目
```php 
'defaults' => [
    'guard' => 'auth',// api -> auth，即为 `guards` 中的 `auth`
    'passwords' => 'users',
], 
...
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'api' => [
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
    ],
    'auth' => [// 我们设置的是这个
        'driver' => 'jwt',
        'provider' => 'auth_admins',
    ],
],
...
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    
    'auth_admins' => [
        'driver' => 'eloquent',
        'model' => Modules\Api\Models\AuthAdmin::class,
    ],
],
```


## 1. 登录路由

`modules/Api/Routes/api.php`

```php 
// 接口 v1 版本 auth权限管理分组路由 分组
Route::group(['prefix' => 'v1', 'middleware' => 'auth.api'], function() {
    
    /************************ AuthController ***************************/
    // 登录
    Route::post('/auth/login', [AuthController::class, 'login']);
    // 退出登录
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    // 刷新token
    Route::post('/auth/token-refresh', [AuthController::class, 'refreshToken']);
    // 修改密码
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);
    // 获取管理员信息
    Route::get('/auth/admin/info', [AuthController::class, 'adminInformation']);
    
}
```

## 2. 新增AuthAdmin模型
`modules/Api/Models/AuthAdmin.php`

```php 
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

    public $table = 'auth_admins';// 关联哪张表
    protected $guard = 'auth';// 在 config/auth.php -> guards.auth
    protected $hidden = [// 设置模型中的隐藏字段，不需要输出 password
        'password',
    ];

    /**
     * 接口方法：JWTSubject
     * jwt标识，即 config/jwt.php -> secret
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 接口方法：getJWTCustomClaims
     * jwt 自定义声明
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}

```

## 3. AuthController
`modules/Api/Http/Controllers/v1/AuthController`

```php 
<?php
namespace Modules\Api\Http\Controllers\v1;

use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Requests\ChangePasswordRequest;
use Modules\Api\Http\Requests\LoginRequest;
use Modules\Api\Services\AuthService;
use Modules\Api\Services\TokenService;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends ApiController
{
    public function __construct()
    {
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
    
}
```

## 4. 自定义Request验证用户名和密码输入
`modules/Api/Http/Requests/LoginRequest.php`

```php 

namespace Modules\Api\Http\Requests;

class LoginRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required',],
            'password' => ['required',],
        ];
    }


    public function messages(){
        return [
            'username.required' => '请输入管理员用户名',
            'password.required' => '请输入管理员密码',
        ];
    }
}
```

## 5. 编写Service服务类
`modules/Api/Services/AuthService.php`

```php 
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
```

`modules/Api/Services/TokenService.php`
```php 
<?php

namespace Modules\Api\Services;

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
```

## 相关文档
* [JWT Auth 文档](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/) 
