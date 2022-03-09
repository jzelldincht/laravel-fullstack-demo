<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\v1\IndexController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// 走的是 modules/Api 模块
// 前缀 + 中间件
Route::group(['prefix' => 'test', 'middleware' => 'auth.api'], function() {
    Route::match(['GET', 'POST'], '/goods', function() {
        return 'Hello World';
    });

    # 路由与控制器绑定
    Route::get('/vvv', [IndexController::class, 'index']);

    # 自定义验证
    Route::post('/vvv', [IndexController::class, 'validate']);

    # 文件上传
    Route::post('/upload', [IndexController::class, 'upload']);
});

