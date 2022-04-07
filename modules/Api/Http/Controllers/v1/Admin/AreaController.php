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
 * @date 2022/4/6 09:57
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Controllers\v1\Admin;

use Modules\Api\Services\Admin\AreaService;
use Modules\Api\Http\Controllers\ApiController;

/**
 * 图片管理控制器
 */
class AreaController extends ApiController
{
    /**
     * 获取地区数据信息
     * @return mixed
     */
    public function getData(){
        return AreaService::getInstance()->getData();
    }

}
