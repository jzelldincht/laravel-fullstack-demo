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
 * @date 2022/3/10 14:05
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Common\Variables;

/**
 * 该类保存自定义返回错误信息
 * 模块或应用自定义状态码对应的错误信息
 */
class ResponseMessage
{

    const INVALID_REQUEST = 'Invalid Request.';// Invalid request.
    const UNAUTHORIZED = 'Authorization Required.';// Authorization required
    const INTERNAL_SERVER_ERROR = 'Internal Server Error.'; // Internal server error.
    const NOT_FOUND = 'Not Found';// Not found
    const OK = 'OK';// Successfully

}
