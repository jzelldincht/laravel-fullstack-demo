<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_areas', function (Blueprint $table) {
            $table->integer('id')->unique('unique_id')->comment('地区表ID，可用于排序');//注意不是自增id
            $table->integer('pid')->default(0)->comment('父级ID');
            $table->string('name',50)->default('')->comment('名称');
            $table->string('short_name',50)->default('')->comment('简称');
            $table->string('merger_name', 200)->default('')->comment('合并名称');
            $table->tinyInteger('level_type')->default(1)->comment('级别');
            $table->integer('city_code')->nullable()->comment('区号');
            $table->integer('zip_code')->nullable()->comment('邮编');
            $table->string('lng',50)->nullable()->comment('经度');
            $table->string('lat',50)->nullable()->comment('纬度');
            $table->string('pinyin',50)->nullable()->comment('拼音');
            $table->tinyInteger('status')->default(1)->comment('显示状态:0=隐藏,1=显示');
        });

        // 给表加注释
        DB::statement('ALTER TABLE `io_auth_areas` comment "地区表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_areas');
    }
}
