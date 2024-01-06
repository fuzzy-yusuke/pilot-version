<?php

use App\Http\Controllers\CarController;
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
Route::post('/car/update', [App\Http\Controllers\CarController::class, 'update']);
Route::delete('/car/delete', [App\Http\Controllers\CarController::class, 'delete']);
// 所属マスタ
Route::get('/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('tenant.department');

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
