# Laravel-modules安装
这是一个模块化开发的扩展，可以把业务逻辑写在modules目录下，可以更好的管理自己的业务逻辑。

## composer安装
```php 
composer require nwidart/laravel-modules
```

## 生成模块的配置文件
发布模块配置文件到目录`\config\modules.php`下。

```php 
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```

### 修改`\config\modules.php`中的配置
```php 
...
'paths' => [
    ...
    - 'modules' => base_path('Modules'),
    + 'modules' => base_path('modules'),
],
...
```

## 生成一个Admin模块
该命令会在

```php 
php artisan module:make Admin
```

## 配置根目录下的composer.json
要使模块目录中定义的类可被自动加载，则要做如下配置。

```php 
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/",
        "Modules\\": "modules/"
    }
},
```
**注意**：这里的`Modules\\`以`\\`双斜杠结束。

配置完成，执行如下命令，使修改生效。

```php 
composer dump-autoload
```
