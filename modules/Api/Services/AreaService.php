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

use Modules\Api\Models\AuthArea;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;

class AreaService extends ApiService
{

    /**
     * 获取地区数据
     */
    public function getData()
    {
        $cache_key = config('api.cacheKeys.areasData');
        $list = cache()->get($cache_key);
        if(!$list) {
            $model = AuthArea::query();
            $list = $model->orderBy('id', 'ASC')
                ->where('status', 1)
                ->get()
                ->toArray();

            if(!$list) {
                $this->fail(ResponseMessage::COMMON_ERROR, ResponseStatus::QUERY_FAILD);
            }

            $list = $this->tree($list);
            $list = $list[0]['children'];
            cache()->put($cache_key, $list, config('api.areasDataExpires'));
        }

        return $this->success(ResponseMessage::OK, $list);
    }


}
