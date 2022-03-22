<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_admins', function (Blueprint $table) {
            // $table->comment = '管理员表';

            $table->increments('id')->comment('ID');
            $table->string('name', 100)->default('')->comment('姓名');
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->string('phone', 100)->default('')->comment('手机号');
            $table->string('username', 50)->unique()->default('')->comment('用户名');
            $table->string('password')->default('')->comment('密码');
            $table->integer('group_id')->nullable()->comment('权限组ID');
            $table->integer('project_id')->nullable()->comment('项目ID');
            $table->tinyInteger('status')->default(1)->comment('状态:0=禁用,1=启用');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            $table->timestamp('updated_at')->nullable()->comment('更新时间');
        });


        Schema::create('auth_groups', function (Blueprint $table) {
            // $table->comment = '权限组表';
            $table->increments('id')->comment('ID');
            $table->string('name', 100)->unique()->default('')->comment('名称');
            $table->string('content')->nullable()->default('')->comment('描述');
            $table->tinyInteger('status')->default(1)->comment('状态:0=禁用,1=启用');
            $table->longText('rules')->nullable()->comment('权限规则多个用|隔开');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            $table->timestamp('updated_at')->nullable()->comment('更新时间');
        });

        Schema::create('auth_rules', function (Blueprint $table) {
            // $table->comment = '权限表';
            $table->increments('id')->comment('ID');
            $table->string('path', 100)->nullable()->default('')->comment('标识');
            $table->string('url')->nullable()->default('')->comment('路由url');
            $table->string('redirect', 100)->nullable()->default('')->comment('重定向路径');
            $table->string('name', 100)->default('')->comment('权限名称');
            $table->tinyInteger('type')->default(1)->comment('菜单类型：1=模块,2=目录,3=菜单');
            $table->tinyInteger('status')->default(1)->comment('状态:0=禁用,1=启用');
            $table->tinyInteger('auth_open')->default(1)->comment('是否验证权限:0=否,1=是');
            $table->integer('level')->default(1)->comment('级别');
            $table->tinyInteger('affix')->default(0)->comment('是否固定面板:0=否,1=是');
            $table->string('icon', 50)->nullable()->default('')->comment('图标名称');
            $table->string('pid')->default(0)->comment('父级ID');
            $table->string('sort')->default(1)->comment("排序");
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            $table->timestamp('updated_at')->nullable()->comment('更新时间');
        });


        // 给表加注释
        DB::statement('ALTER TABLE `auth_admins` comment "管理员权限表"');
        DB::statement('ALTER TABLE `auth_groups` comment "权限组表"');
        DB::statement('ALTER TABLE `auth_rules` comment "权限表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_admins');
        Schema::dropIfExists('auth_groups');
        Schema::dropIfExists('auth_rules');
    }
}
