<?php

use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\User\LoginController;
use App\Http\Controllers\Api\Admin\User\RegisterController;
use App\Http\Controllers\Api\Admin\Utils\CaptchaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return apiResponse(0, [], 'success');
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
Route::get('/captcha', [CaptchaController::class, 'captcha'])->name('captcha.create');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('menus', MenuController::class)->except(['create', 'edit']); // 菜单 api 资源
});

