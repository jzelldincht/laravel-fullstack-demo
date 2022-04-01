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

use Illuminate\Support\Facades\Cache;
use Modules\Common\Variables\ResponseMessage;

class ToolService extends ApiService
{
    /**
     * TODO：后面需要编写清除功能
     */
    public function clearCache(): \Illuminate\Http\JsonResponse
    {
        return $this->apiSuccess(ResponseMessage::OK);
    }

    /**
     * 通过key清除缓存
     * @param $key
     * @return bool
     */
    public function removeCacheByKey($key){
        Cache::forget($key);
        return true;
    }

    /**
     * 缓存数据
     */
    public function saveCache($key, $value = null)
    {
        if(!$key) {
            return false;
        }

        // 如果只有key，则取数据
        if($value == null){
            return Cache::get($key);
        } else {// 否则设置数据
            Cache::put($key, $value, config('api.cacheExpires'));
        }
    }


}
