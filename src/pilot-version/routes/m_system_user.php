<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;

/*
システム管理者系ページ
*/
// システム管理者用ログイン
Route::get(
    'loginex',
    [Admin\LoginController::class, 'index']
)->name('admin.login.index');
Route::post('loginex', [Admin\LoginController::class, 'login'])->name('admin.login.login');

Route::prefix('admin')->group(function () {
    Route::get('logout', [Admin\LoginController::class, 'logout'])->name('admin.login.logout');
    Route::get('/', [Admin\IndexController::class, 'dashboard'])->name('admin.dashboard');
});
