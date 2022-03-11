<?php

namespace Modules\Common\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 模型基类
 * @mixin Builder
 */
class BaseModel extends Model
{
    // 是否主动维护时间戳
    public $timestamps = false;
}
