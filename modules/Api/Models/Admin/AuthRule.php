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
 * @date 2022/4/1 11:04
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Models\Admin;

/**
 * 权限模型
 */
class AuthRule extends ApiModel
{
    public $table = 'auth_rules';
    protected $hidden = [// 设置模型中的隐藏字段，不需要输出 password
    ];

    /**
     * 获取所有的规则列表，通常是超级管理员时获取
     * type_id = 1 模块
     * type_id = 2 目录
     * type_id = 3 菜单
     *
     * 获取模块时，传入 type = 1
     * @param array|string $columns
     * @param string $operator 默认是 =, 获取的是模块 ; `!=`, 当获取菜单时（后台左侧菜单）type_id <> 1
     * @return array
     */
    public static function allRules($columns = ['*'], $operator = '=', $rule_ids = null) {
        $query = self::query()->where('type', $operator, 1);

        if($rule_ids) {
            $query->whereIn('id', $rule_ids);
        }

        return $query->select($columns)
            ->orderBy('sort')
            ->get()
            ->toArray();
    }

    /**
     * 获取rules并返回所有rules（菜单或项目或模块）
     * @param $rule_ids
     * @param array|string $columns
     * @return array
     */
    public static function getRulesInIds($rule_ids, $columns = ['*']): array
    {
        return self::query()->where('type', 1)
            ->select($columns)
            ->whereIn('id', $rule_ids)
            ->orderBy('sort')
            ->get()
            ->toArray();
    }
}
