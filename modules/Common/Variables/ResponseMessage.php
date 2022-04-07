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

    const PARSE_ERROR = 'Syntax Error.';// 语法错误

    const REFLECTION_EXCEPTION = 'Reflection Exception.';// 异常映射
    const RUNTIME_EXCEPTION = 'Runtime Exception.';// 运行期异常 运行时异常 运行异常 未检查异常
    const ERROR_EXCEPTION = 'Error Exception.';// 框架运行出错

    const INVALID_ARGUMENT_EXCEPTION = 'Invalid argument exception.';// 数据库链接问题
    const QUERY_EXCEPTION = 'Query Exception.';// 数据库DB Query错误
    const MODEL_NOT_FOUND_EXCEPTION = 'Model Not Found Exception.';// 数据库链接问题
    const PDO_EXCEPTION = 'PDO Exception.';// PDO异常

    const COMMON_EXCEPTION = 'Network Error.';// 通用异常，不方便显示异常信息时，展示此信息。

    const API_ERROR_EXCEPTION = 'Operation failed!';
    const ADD_API_ERROR = 'Failed to add!';
    const ADD_API_SUCCESS = 'Added successfully!';
    const UPDATE_API_ERROR = 'Failed to update!';
    const UPDATE_API_SUCCESS = 'Updated successfully!';
    const STATUS_API_ERROR = 'Failed to modify status!';
    const STATUS_API_SUCCESS = 'Status modified successfully!';

    const DELETE_API_ERROR = 'Failed to delete!';
    const DELETE_API_SUCCESS = 'Successfully deleted!';

    const DELETE_RECYCLE_API_ERROR = 'Recovery failed!';
    const DELETE_RECYCLE_API_SUCCESS = 'Recovery successfully!';

    const TOKEN_ERROR_KEY = 'Invalid api key!';     // 70001
    const TOKEN_ERROR_SET = 'Please log in first!';        // 70002
    const TOKEN_ERROR_BLACK = 'The token has been blacklisted!';  // 70003
    const TOKEN_ERROR_EXPIRED = 'Token has expired!';  // 70004
    const TOKEN_ERROR_JWT = 'Please log in first!';         //  70005
    const TOKEN_ERROR_JTB = 'Please log in first!';          // 70006

    const INVALID_USERNAME_OR_PASSWORD = 'Username or password is invalid.'; // 90001
    const INVALID_OLD_PASSWORD = 'Invalid original password!';// 90002 //原密码错误，场景：修改管理员密码——验证原始密码

    const IMAGE_UPLOADED_FAILURE = 'Uploaded failed.';// 图片上传失败

    const INVALID_PARAMETERS = 'Invalid parameter(s).';//无效的参数
    const COMMON_ERROR = 'Somethin went wrong, please try again later.';//
}
