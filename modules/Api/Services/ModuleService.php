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
use Modules\Api\Models\AuthRule;
use Modules\Common\Variables\ResponseMessage;

class ModuleService extends ApiService
{

    /**
     * 获取模块信息
     */
    public function getModules(){
        // 获取用户
        $admin = auth()->user()->toArray();
        $group_id = $admin['group_id'];// 当group_id为1时是超级管理员

        $columns = ['id', 'path', 'url', 'status', 'icon', 'pid','name', 'sort'];

        $data = [];
        if($group_id != 1) {// 如果当前账户不是超级管理员
            // 需要先查询 auth_group 分组，查询该用户分组对应的权限
            $admin_rules = AuthGroup::getRulesByGroupId($group_id);// 直接返回 rules 字段数据
            if($admin_rules) {
                // 如果查询有结果，则再查询对应的权限表 auth_rules
                $rule_ids = explode('|', $admin_rules);
                $data = AuthRule::getRulesInIds($rule_ids, $columns);
            }
        } else {// 如果当前账户是超级管理员
            // 查询 auth_rules 表，type=1的就是模块，
            $data = AuthRule::allRules($columns);
        }

        return $this->apiSuccess(ResponseMessage::OK, $data);
    }

    /**
     * 获取菜单
     */
    public function getMenus($mid = null)
    {
        $data = [];

        if((int)$mid <= 0) {
            return $data;
        }

        $admin_info = auth()->user()->toArray();
        $group_id = $admin_info['group_id'];

        // 获取所有目录和菜单
        $columns = ['id', 'pid'];
        $rules = AuthRule::allRules($columns, '!=');

        if($group_id != 1){// 如果当前账户不是超级管理员
            // 获取所有权限id，形如：1|2|3|10
            $admin_rule_ids_string = AuthGroup::getRulesByGroupId($group_id);
            if($admin_rule_ids_string){
                // 模块id获取对应的菜单
                $rule_ids = RuleService::getInstance()->moduleRuleIds($rules, 1);
                $admin_rule_ids = explode('|', $admin_rule_ids_string);
                // 求交集，待确定是否有bug哦
                $rule_ids = array_intersect($rule_ids, $admin_rule_ids);
            }
        } else {// 当前用户是管理员
            $rule_ids = RuleService::getInstance()->moduleRuleIds($rules, 1);
        }

        // 当 rule_ids 不为空时，获取所有菜单
        if(!empty($rule_ids) && count($rules) > 0) {
            $data = AuthRule::allRules(['*'], '!=', $rule_ids);
        }

        return $this->apiSuccess('',$data);
    }
}
