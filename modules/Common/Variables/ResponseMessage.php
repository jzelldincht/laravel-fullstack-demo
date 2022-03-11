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

    const API_ERROR_EXCEPTION = '操作失败！';
    const ADD_API_ERROR = '添加失败！';
    const ADD_API_SUCCESS = '添加成功！';
    const UPDATE_API_ERROR = '修改失败！';
    const UPDATE_API_SUCCESS = '修改成功！';
    const STATUS_API_ERROR = '调整失败！';
    const STATUS_API_SUCCESS = '调整成功！';

    const DELETE_API_ERROR = '删除失败！';
    const DELETE_API_SUCCESS = '删除成功！';

    const DELETE_RECYCLE_API_ERROR = '恢复失败！';
    const DELETE_RECYCLE_API_SUCCESS = '恢复成功！';

    const TOKEN_ERROR_KEY = 'apikey错误！';     // 70001
    const TOKEN_ERROR_SET = '请先登录！';        // 70002
    const TOKEN_ERROR_BLACK = 'token 被拉黑！';  // 70003
    const TOKEN_ERROR_EXPIRED = 'token 过期！';  // 70004
    const TOKEN_ERROR_JWT = '请先登录！';         //  70005
    const TOKEN_ERROR_JTB = '请先登录！';          // 70006
}
