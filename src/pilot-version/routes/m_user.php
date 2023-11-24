<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

/*
テナントユーザー系ページ
*/

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.login');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');

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
