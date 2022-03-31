<?php

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\v1\AuthController;

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
    // 登录
    Route::post('/auth/login', [AuthController::class, 'login']);

    // 退出登录
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // 刷新token
    Route::post('/auth/token-refresh', [AuthController::class, 'refreshToken']);

    // 修改密码
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);


    // 获取管理员信息
    Route::get('/auth/admin/info', [AuthController::class, 'adminInformation']);

});
