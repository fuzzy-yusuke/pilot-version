<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
テナントユーザー系ページ
*/

Auth::routes();

// テナントユーザー用ダッシュボード
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('tenant.dashboard');
// 自動車マスタ
Route::get('/car', [App\Http\Controllers\CarController::class, 'index'])->name('tenant.car');
// // 所属マスタ
// Route::get(
//     '/departments',
//     [App\Http\Controllers\DepartmentsController::class, 'departments']
// )->name('tenant.departments');
// // 運転日報
// Route::get(
//     '/drivinglogs',
//     [App\Http\Controllers\DrivingLogsController::class, 'drivinglogs']
// )->name('tenant.drivinglogs');
// // PDFデータ取り込み
// Route::post(
//     '/pdfinput',
//     [App\Http\Controllers\PdfInputController::class, 'pdfinput']
// )->name('tenant.pdfinput');
