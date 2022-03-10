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
 * @date 2022/3/10 12:31
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Exceptions;

use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use Throwable;

class ApiException extends \Exception
{
    /**
     * Api异常接管
     * @param array $errdata [status => httpCode, message => error information]
     * @param Throwable|null $previous
     */
    public function __construct(array $errdata = ['status' => ResponseStatus::BAD_REQUEST, 'message' => ResponseMessage::INTERNAL_SERVER_ERROR], Throwable $previous = null)
    {
        parent::__construct($errdata['message'], $errdata['status'], $previous);
    }
}
