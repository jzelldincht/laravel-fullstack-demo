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
 * 权限分组模型
 */
class AuthGroup extends ApiModel
{
    public $table = 'auth_groups';
    protected $hidden = [// 设置模型中的隐藏字段，不需要输出 password
    ];

    /**
     * 通过管理员的 group_id 规则列表
     * @param $group_id
     * @return mixed
     */
    public static function getRulesByGroupId($group_id) {
        return self::query()->where('id', $group_id)->select('rules')->value('rules');// 直接返回 rules 字段数据
    }
}
