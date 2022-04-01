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

class RuleService extends ApiService
{
    /***
     * 递归遍历数据
     * 将所有的规则数据，全部转化成一维数组，要求：所有在原始模块ID下的所有规则均要被提取！
     * @param int $module_id 当前删除数据id
     * @param array $rules 要处理的数据
     *              [
     *                  [id => , pid => ],
     *                  [id => , pid =>]
     *              ]
     * @return array 返回获取当前的删除id的其他子id
     **/
    public function moduleRuleIds($rules, $module_id = 0)
    {
        //创建新数组
        static $arr = [];

        foreach ($rules as $k => $v) {
            if ($v['pid'] == $module_id) {
                $arr[] = $v['id'];
                unset($rules[$k]);
                $this->moduleRuleIds($rules, $v['id']);
            }
        }

        return $arr;
    }
}
