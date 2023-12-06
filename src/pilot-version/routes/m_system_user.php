<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;

/*
システム管理者系ページ
*/
// システム管理者用ログイン
Route::get(
    '/system/login',
    [App\Http\Controllers\LoginExController::class, 'loginex']
)->name('system.loginex');
// システム管理者用ダッシュボード
Route::get(
    '/system/dashboard',
    [App\Http\Controllers\DashboardSystemController::class, 'dashboardsystem']
)->name('system.dashboardsystem');
