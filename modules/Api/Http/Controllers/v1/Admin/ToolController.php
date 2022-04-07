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
 * @date 2022/4/1 10:14
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Controllers\v1\Admin;

use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Services\Admin\ToolService;

class ToolController extends ApiController
{
    /**
     * TODO: 清除缓存
     * 说明：该功能会清除站点缓存的所有数据
     */
    public function clearCache(){
        return ToolService::getInstance()->clearCache();
    }


}
