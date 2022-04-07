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

namespace Modules\Api\Http\Controllers\v1\Admin;

use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Requests\Admin\ModuleIdRequest;
use Modules\Api\Services\Admin\ModuleService;

class IndexController extends ApiController
{
    /**
     * 获取模块信息
     */
    public function getModules()
    {
        return ModuleService::getInstance()->getModules();
    }

    /**
     * 获取指定模块的菜单
     * @param ModuleIdRequest $request
     * @return mixed
     */
    public function getMenus(ModuleIdRequest $request)
    {
        return ModuleService::getInstance()->getMenus($request->get('mid'));
    }
}
