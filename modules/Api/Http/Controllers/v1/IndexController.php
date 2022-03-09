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
 * @date 2022/3/9 10:17
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Requests\TestRequest;

class IndexController extends ApiController
{
    public function index() {
        return 'Api 1';
    }

    /**
     * 验证请求信息
     * 验证的文档：https://laravelacademy.org/post/21984
     */
    public function validate(TestRequest $request)
    {
        return '验证通过';
    }
}
