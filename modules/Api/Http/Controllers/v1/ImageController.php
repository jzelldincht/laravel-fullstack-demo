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

use Modules\Api\Http\Requests\ImageRequest;
use Modules\Api\Services\ImageService;

/**
 * 图片管理控制器
 */
class ImageController extends \Modules\Api\Http\Controllers\ApiController
{
    public function upload(ImageRequest $request) {
        return ImageService::getInstance()->save($request->uploaded_path);
    }

    public function getList() {

    }
}
