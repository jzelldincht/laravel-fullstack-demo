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
 * @date 2022/3/10 13:58
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Common\Variables;

/**
 * 该类保存自定义返回状态码
 * 模块或应用自定义状态码
 */
class ResponseStatus
{
    const BAD_REQUEST = 40000;// Invalid request.
    const UNAUTHORIZED = 40100;// Authorization required
    const INTERNAL_SERVER_ERROR = 50000; // Internal server error.
    const NOT_FOUND = 40400;// Not found
    const OK = 20000;// Successfully

}
