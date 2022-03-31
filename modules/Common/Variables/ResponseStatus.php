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

    const PARSE_ERROR = 50001;// 语法错误
    const REFLECTION_EXCEPTION = 50002;// 异常映射
    const RUNTIME_EXCEPTION = 50003;// 运行期异常 运行时异常 运行异常 未检查异常
    const ERROR_EXCEPTION = 50004;// 框架运行出错

    const INVALID_ARGUMENT_EXCEPTION = 60001;// 数据库链接问题
    const QUERY_EXCEPTION = 60002;// 数据库DB Query错误
    const MODEL_NOT_FOUND_EXCEPTION = 60003;// 数据库模型未找到
    const PDO_EXCEPTION = 60004;// PDO异常

    const TOKEN_ERROR_KEY = 70001;
    const TOKEN_ERROR_SET = 70002;
    const TOKEN_ERROR_BLACK = 70003;
    const TOKEN_ERROR_EXPIRED = 70004;
    const TOKEN_ERROR_JWT = 70005;
    const TOKEN_ERROR_JTB = 70006;

    const API_ERROR_EXCEPTION = 80001;
    const ADD_API_ERROR = 80002;
    const ADD_API_SUCCESS = 81003;
    const UPDATE_API_ERROR = 80003;
    const UPDATE_API_SUCCESS = 81002;
    const STATUS_API_ERROR = 80004;
    const STATUS_API_SUCCESS = 81001;

    const COMMON_EXCEPTION = 10000;// 通用异常，不方便显示异常信息时，展示此信息。

    // 以下为提示信息
    const INVALID_USERNAME_OR_PASSWORD = 90001;//用户名或密码错误
    const INVALID_OLD_PASSWORD = 90002;//原密码错误，场景：修改管理员密码——验证原始密码
}
