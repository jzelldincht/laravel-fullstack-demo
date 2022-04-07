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

namespace Modules\Api\Http\Controllers\v1;

use Modules\Api\Http\Requests\ImageListRequest;
use Modules\Api\Http\Requests\ImageRequest;
use Modules\Api\Services\AreaService;
use Modules\Api\Services\ImageService;

/**
 * 图片管理控制器
 */
class AreaController extends \Modules\Api\Http\Controllers\ApiController
{
    public function getData(){
        return AreaService::getInstance()->getData();
    }

}
