# Laravel 安装 jwt_auth

## 1. 安装 jwt-auth
```php 
composer require tymon/jwt-auth 1.*@rc
```

## 2. 将服务提供程序添加到配置文件中的 providers 数组, config/app.php 如下所示：
```php 
...
'providers' => [
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
],
...
'aliases' => [
    ...
    'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,
    'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,
    ...
],
```

## 3. 运行以下命令以发布程序包配置文件
```php 
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

## 4. 生成加密密钥，请查看 .env 文件 JWT_SECRET
```php 
php artisan jwt:secret
```

## 5. 修改 config/auth.php
```php 
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
    'auth' => [
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

    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],

    'auth_admins' => [// 指向 guards.auth.provider
        'driver' => 'eloquent',
        'model' => Modules\Api\Models\AuthAdmin::class,// 暂时没有 AuthAdmin 类
    ],
],
```


