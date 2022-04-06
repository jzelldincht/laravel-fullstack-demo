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

namespace Modules\Api\Models;

/**
 * 权限模型
 */
class AuthImage extends ApiModel
{
    public $table = 'auth_images';
    protected $hidden = [// 设置模型中的隐藏字段，不需要输出 password
    ];


}
