<?php

use Illuminate\Support\Facades\Route;

/*
システム管理者系ページ
*/
// システム管理者用ログイン
Route::get(
    'loginex',
    [App\Http\Controllers\Admin\LoginController::class, 'form']
)->name('admin.login');
Route::post('loginex', [App\Http\Controllers\Admin\LoginController::class, 'login']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin-web'], function () {
    Route::post('logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [App\Http\Controllers\Admin\IndexController::class, 'dashboard'])->name('admin.dashboard');

    //テナント管理マスタ
    Route::get('/tenant', [App\Http\Controllers\Admin\TenantController::class, 'index'])->name('tenant.car');
    Route::post('/tenant/create', [App\Http\Controllers\Admin\TenantController::class, 'create']);
    Route::post('/tenant/update', [App\Http\Controllers\Admin\TenantController::class, 'update']);
    Route::post('/tenant/delete', [App\Http\Controllers\Admin\TenantController::class, 'delete']);
});
