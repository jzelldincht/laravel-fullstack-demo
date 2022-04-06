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
 * @date 2022/4/1 10:21
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Services;

use Modules\Api\Models\AuthGroup;
use Modules\Api\Models\AuthImage;
use Modules\Api\Models\AuthRule;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;

class ImageService extends ApiService
{

    /**
     * 文件上传并保存数据
     */
    public function save($uploaded_url)
    {
        if ($uploaded_url) {
            // 存入数据库
            $image_id = AuthImage::insertGetId([
                'url' => $uploaded_url,
                'open' => request()->post('image_status', 1),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if($image_id) {
                return $this->success(ResponseMessage::OK, [
                    'image_id' => $image_id,
                    'url' => $uploaded_url,
                ]);
            }
        }

        $this->fail(ResponseMessage::IMAGE_UPLOADED_FAILURE, ResponseStatus::IMAGE_UPLOADED_FAILURE);
    }
}