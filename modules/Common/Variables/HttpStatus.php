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
 * @date 2022/3/10 13:14
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Common\Variables;

/**
 * 状态码信息
 * 1**;请求收到，继续处理
 * 2**;操作成功收到，分析、接受
 * 3**;完成此请求必须进一步处理
 * 4**;请求包含一个错误语法或不能完成
 * 5**;服务器执行一个完全有效请求失败
 */
class HttpStatus
{
    const CONTINUE = 100;// 客户必须继续发出请求
    const SWITCHING_PROTOCOLS = 101;// 客户要求服务器根据请求转换HTTP协议版本
    const PROCESSING = 102;// 将继续执行请求

    const OK = 200;// 交易成功

    const CREATED = 201;// 提示知道新文件的URL
    const ACCEPTED = 202;// 接受和处理、但处理未完成
    const NON_AUTHORIATIVE_INFORMATION = 203;// 返回信息不确定或不完整
    const NO_CONTENT = 204;// 请求收到，但返回信息为空
    const RESET_CONTENT = 205;// 服务器完成了请求，用户代理必须复位当前已经浏览过的文件
    const PARTIAL_CONTENT = 206;// 服务器已经完成了部分用户的GET请求
    const MULTI_STATUS = 207;// 由WebDAV(RFC 2518)扩展的状态码，代表之后的消息体将是一个XML消息，并且可能依照之前子请求数量的不同，包含一系列独立的响应代码。

    const MULTIPLE_CHOICES = 300;// 请求的资源可在多处得到
    const MOVED_PERMANENTLY = 301;// 删除请求数据
    const FOUND = 302;// 在其他地址发现了请求数据
    const SEE_OTHER = 303;// 建议客户访问其他URL或访问方式
    const NOT_MODIFIED = 304;// 客户端已经执行了GET，但文件未变化
    const USER_PROXY = 305;// 请求的资源必须从服务器指定的地址得到
    const UNUSED = 386;// 前一版本HTTP中使用的代码，现行版本中不再使用
    const TEMPORARY_REDIRECT = 307;// 申明请求的资源临时性删除

    const BAD_REQUEST = 400;// 错误请求，如语法错误
    const UNAUTHORIZED = 401;// 请求授权失败
    const PAYMENT_GRANTED = 402;// 保留有效ChargeTo头响应
    const FORBIDDEN = 403;// 请求不允许
    const FILE_NOT_FOUND = 404;// 没有发现文件、查询或URL
    const METHOD_NOT_ALLOWED = 405;// 不允许的请求方法
    const NOT_ACCEPTABLE = 406;// 根据用户发送的Accept拖，请求资源不可访问
    const PROXY_AUTHENTICATION_REQUIRED = 407;// 类似401，用户必须首先在代理服务器上得到授权
    const REQUEST_TIME_OUT = 408;// 客户端没有在用户指定的饿时间内完成请求
    const CONFLICT = 409;// 对当前资源状态，请求不能完成
    const GONE = 410;// 服务器上不再有此资源且无进一步的参考地址
    const LENGTH_REQUIRED = 411;// 服务器拒绝用P定义的Content-Length属性请求
    const PRECONDITION_FAILED = 412;// 一个或多个请求头字段在当前请求中错误
    const REQUEST_ENTITY_TO0_LARGE = 413;// 请求的资源大于服务器允许的大小
    const REQUEST_URL_TO0_LARGE = 414;// 请求的资源URL长于服务器允许的长度
    const UNSUPPORTED_MEDIA_TYPE = 415;// 请求资源不支持请求项目格式
    const REQUESTED_RANGE_NOT_SATISFIABLE = 416;// 请求中包含Range请求头字段，在当前请求资源范围内没有range指示值，请求也不包含If-Range请求头字段
    const EXPECTATION_FAILED = 417;// 服务器不满足请求Expect头字段指定的期望值，如果是代理服务可能是下一级服务器不能满足请求
    const UNPROCESSABLE_ENTITY = 422;// 表示请求格式正确，但是由于含有语义错误，无法响应。
    const LOCKED = 423;// 当前资源被锁定
    const FAILED_DEPENDENCY = 424;// 表示由于之前的某个请求发生的错误，导致当前请求失败，例如PROPPATCH。

    const INTERNAL_SERVER_ERROR = 500;// 服务器产生内部错误
    const NOT_IMPLEMENTED = 501;// 服务器不支持请求的函数
    const BAD_GATEWAY = 502;// 服务器暂时不可用，有时是为了防止发生系统过载
    const SERVICE_UNAVAILABLE = 503;// 服务器过载或暂停维修
    const GATEWAY_TIMEOUT = 504;// 关口过载，服务器使用另一个关口或服务来响应用户，等待时间设定较长
    const HTTP_VERSIAN_ONT_SUPPORTED = 505;// 服务器不支持或拒绝支请求头中指定的HTTP版本
    const VARIANT_ALSO_NEGOTIATES = 506; // 由《透明内容协商协议》（RFC 2295）扩展，代表服务器存在内部配置错误：被请求的协商变元资源被配置为在透明内容协商中使用自己，因此在一个协商处理中不是一个合适的重点。
    const INSUFFICIENT_STORAGE = 507;// 表示服务器无法存储完成请求所必须的内容。这个状况被认为是临时的。
}
