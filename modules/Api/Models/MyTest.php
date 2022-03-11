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
 * @date 2022/3/11 20:01
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class MyTest extends ApiModel
{
    // 设置 created_at 创建时间
    const CREATED_AT = 'created_at';
    // 设置 updated_at 更新时间
    const UPDATED_AT = 'updated_at';

    // 设置当前模型使用的数据库连接名
    protected $connection = 'mysql';

    // 指定表名
    protected $table = 'article';

    // 指定主键
    protected $primaryKey = 'id';

    // 是否是主键自增
    public $incrementing = true;

    // 自增ID的数据类型
    protected $keyType = 'int';

    // 是否主动维护时间戳
    public $timestamps = false;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'delayed' => false,
    ];

}
