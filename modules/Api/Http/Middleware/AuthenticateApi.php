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
 * @date 2022/3/9 10:33
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Middleware;

use Closure;

class AuthenticateApi
{
    public function handle($request, Closure $next)
    {
        // here is your code
        // exit('///Authenticate Api Middleware');

        return $next($request);
    }
}
