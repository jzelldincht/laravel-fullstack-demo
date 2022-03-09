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

namespace Modules\Admin\Http\Controllers\v1;

use Modules\Admin\Http\Controllers\AdminController;

class IndexController extends AdminController
{
    public function index() {
        return 'DO 1';
    }
}
