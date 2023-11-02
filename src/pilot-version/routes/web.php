<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
