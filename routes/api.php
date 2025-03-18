<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CaptchaController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 测试用
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return apiResponse(0, [], 'success');
})->middleware('auth:sanctum');

// 登录注册退出部分
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
// 验证码
Route::get('/captcha', [CaptchaController::class, 'captcha'])->name('captcha.create');

// 需要验证的逻辑
Route::middleware(['auth:sanctum'])->group(function () {
    // 菜单相关
    Route::resource('menus', MenuController::class)->except(['create', 'edit']); // 菜单 api 资源
    // 用户相关
    Route::get('/user/info', [UserController::class, 'info'])->name('user.info');// 用户信息
    // 退出登录
    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

