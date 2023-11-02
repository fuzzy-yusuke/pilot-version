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

/*
テナントユーザー系ページ
*/
// テナントユーザー用ダッシュボード
Route::get(
    '/dashboard',
    [App\Http\Controllers\DashboardController::class, 'dashboard']
)->name('tenant.dashboard');
// 自動車マスタ
Route::get(
    '/car',
    [App\Http\Controllers\CarController::class, 'car']
)->name('tenant.car');
// 所属マスタ
Route::get(
    '/departments',
    [App\Http\Controllers\DepartmentsController::class, 'departments']
)->name('tenant.departments');
// 運転日報
Route::get(
    '/drivinglogs',
    [App\Http\Controllers\DrivingLogsController::class, 'drivinglogs']
)->name('tenant.drivinglogs');
// PDFデータ取り込み
Route::post(
    '/pdfinput',
    [App\Http\Controllers\PdfInputController::class, 'pdfinput']
)->name('tenant.pdfinput');
