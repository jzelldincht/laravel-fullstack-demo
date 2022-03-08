# Laravel 安装 
## 安装命令
```php
composer create-project laravel/laravel project-name
```
## Apache伪静态
```php
Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```

## nginx伪静态
```php
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```
