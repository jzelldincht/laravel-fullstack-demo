# Laravel模型开发

## 新建模型

modules/Api/Models/MyTest.php

```php 
<?php

namespace Modules\Api\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent - 可以让IDE找到方法
 * @mixin Builder - 可以主IDE找到方法
 */
class MyTest extends Model
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

```

## 在控制器或者调用的所在使用模型来查询

```php 
/**
 * 使用 Laravel 模型来查询数据
 */
$this->result = MyTest::where('id', 2)->first()->toArray();
dd($this->result);

```


## 相关文档
* [ORM](https://learnku.com/docs/laravel/8.5/eloquent/10409)
