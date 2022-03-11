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

namespace Modules\Api\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Api\Exceptions\ApiException;
use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Requests\FileUploadRequest;
use Modules\Api\Http\Requests\TestRequest;
use Modules\Api\Models\MyTest;
use Modules\Common\Variables\HttpStatus;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;

class IndexController extends ApiController
{
    /**
     * 数据库执行结果
     * @var bool
     */
    public $result = false;

    public function index() {
        throw new ApiException();
    }

    /**
     * 验证请求信息
     * 验证的文档：https://laravelacademy.org/post/21984
     * @throws ApiException
     */
    public function validate(TestRequest $request)
    {
        // 验证通过后，会执行下面的方法
        // 通过input()方法获取的参数包含了 "查询字符串与post的参数两部分“
        $inputs = $request->input();
        // dd($inputs);

        // 获取 name 字段的值
        $name = $inputs['name'];
        // dd($name);

        // 获取请求路径信息
        // https://blog.test/user/1?name=Zell 返回 user/1
        $path = $request->path();
        // dd($path);

        // 获取请求url
        // https://blog.test/user/1?name=Zell 返回 https://blog.test/user/1
        $url = $request->url();
        // dd($url);

        // 获取请求方法
        $method = $request->method();
        // dd($method);


        // 获取查询字符串中的 ?a=Zell 参数a的值
        $name = $request->query('a');
        // dd($name);

        // 获取所有查询参数
        $queries = $request->query();
        // dd($queries);

        // 获取post请求中输入
        $post = $request->post();
        // dd($post);

        // 获取post表单中的name字段值
        // $name = $request->post('name');
        // dd($name);

        // $result = $request->file('avatar')->storePubliclyAs('public/images/avatars', 'avatar.png');
        // dd($result);
        //

        // 获取 IP
        // $ip = $request->getClientIp();
        // dd($ip);

        // 这会抛出PDO_EXCEPTION异常
        // $db = DB::connection('mysql')->select('select * from aomeiio');
        // dd($db);

        // 异常处理测试
        // throw new ApiException(['status' => 123456, 'message' => '打虎李连杰']);

        // 执行到此，成功
        return 'OK';
    }

    /*
     * @name 上传文件
     * @description 测试上传文件用法
     * @author Zell <jzell@qq.com>
     * @method POST
     * @return JSON
     */
    public function upload(FileUploadRequest $request) {
        $uploadedPath = $request->uploadedPath;

        return '上传成功';
    }

    /**
     * 测试DB类
     * 文档
     * @param Request $request
     */
    public function db(Request $request) {
        $table = DB::table('article');

        // // 插入一条数据
        // $this->result = $table->insert([
        //     'title' => '士兵突击',
        //     'body' => 'laravel批量生成假数据_阳水平的博客-CSDN博客',
        //     'avatar' => '',
        //     'cate_id' => 2,
        //     'created_at' => date("Y-m-d H:i:s", time()),
        // ]);
        //
        // $this->result = $table->insert([
        //     'title' => '注定被删的数据',
        //     'body' => '这条数据要被删除的',
        //     'avatar' => '',
        //     'cate_id' => 1,
        //     'created_at' => date("Y-m-d H:i:s", time()),
        // ]);
        //
        // // 更新一条数据
        // $this->result = $table->where('id', '=', 4)->update([
        //     'title' => '单元测试时保证数据库整洁'
        // ]);
        //
        // // 删除一条数据
        // $this->result = $table->delete(5);
        //


        // // --- 查询所有记录
        // $this->result = $table->select('id', 'title', 'body', 'cate_id', 'avatar')
        //     ->get()->toArray();
        //
        //
        // // --- 条件查询
        // $this->result = $table->select('id', 'title', 'body', 'cate_id', 'avatar', 'created_at')
        //     ->where('cate_id', 2)->get()->toArray();
        //
        // // --- 查询某字段的值
        // $this->result = $table->select('title')->where('id', 1)
        //     ->value('id');
        //
        // // --- 查询某列的结果
        // $this->result = $table->where('cate_id', 2)
        //     ->pluck('title');
        //
        // // --- 查询数据库条数
        // $this->result = $table->count('id');
        //
        // // --- 查询最小(大)值
        // $this->result = $table->where('cate_id', 2)->max('id');
        //
        // // --- 查询排序
        // $this->result = $table->where('id', '>=', 2)->orderByDesc('id')
        //     ->get()->toArray();

        // // --- 从结果中获取单行或单列
        // $this->result = $table->where('cate_id', 2)->orderByDesc('created_at')
        //     ->first();// 获取结果集中的最新创建的数据

        // // --- 通过主键字段获取一行
        // $this->result = $table->find(3);

        // // --- 分块结果 chunk: https://learnku.com/docs/laravel/8.5/queries/10404#53a561

        // // --- 判断记录是否存在
        // $this->result = $table->where('id', 77)->exists();


        /**
         * 使用 Laravel 模型来查询数据
         */
        $this->result = MyTest::where('id', 2)->first()->toArray();


        dd($this->result);
    }
}
