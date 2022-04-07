<?php

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\v1\AuthController;
use Modules\Api\Http\Controllers\v1\IndexController;
use Modules\Api\Http\Controllers\v1\ToolController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/api', function (Request $request) {
//     return $request->user();
// });

// 接口 v1 版本 auth权限管理分组路由 分组
Route::group(['prefix' => 'v1', 'middleware' => 'auth.api'], function() {

    /************************ AuthController ***************************/
    // 登录
    Route::post('/auth/login', [AuthController::class, 'login']);
    // 退出登录
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    // 刷新token
    Route::post('/auth/refresh-token', [AuthController::class, 'refreshToken']);
    // 修改密码
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);
    // 获取管理员信息
    Route::get('/auth/admin/info', [AuthController::class, 'adminInformation']);

    /************************ ToolController ***************************/
    // 清除缓存
    Route::post('/cache-clear', [ToolController::class, 'cacheClear']);

    /*********************** IndexController **************************/
    // 获取模块
    Route::get('/module/info', [IndexController::class, 'getModules']);
    // 获取菜单栏
    Route::get('/module/menus', [IndexController::class, 'getMenus']);

    /*********************** ImageController **************************/
    //单图上传
    Route::post('/image/upload', 'v1\ImageController@upload');
    //图片列表
    Route::get('/image/list', 'v1\ImageController@getList');

    /*********************** AreaController **************************/
    Route::post('/areas/data', 'v1\AreaController@getData');
});
