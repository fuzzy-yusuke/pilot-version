<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
テナントユーザー系ページ
*/

Auth::routes(['register' => false]);

// テナントユーザー用ダッシュボード
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('tenant.dashboard');
//社員マスタ
Route::get('/user', [App\Http\Controllers\UserMasterController::class, 'index'])->name('tenant.user');
Route::post('/user/create', [App\Http\Controllers\UserMasterController::class, 'create']);
Route::post('/user/update', [App\Http\Controllers\UserMasterController::class, 'update']);
Route::post('/user/delete', [App\Http\Controllers\UserMasterController::class, 'delete']);
// 自動車マスタ
Route::get('/car', [App\Http\Controllers\CarController::class, 'index'])->name('tenant.car');
Route::post('/car/create', [App\Http\Controllers\CarController::class, 'create']);
Route::post('/car/update', [App\Http\Controllers\CarController::class, 'update']);
Route::post('/car/delete', [App\Http\Controllers\CarController::class, 'delete']);
// 所属マスタ
Route::get('/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('tenant.department');
Route::post('/department/create', [App\Http\Controllers\DepartmentController::class, 'create']);
Route::post('/department/update', [App\Http\Controllers\DepartmentController::class, 'update']);
Route::post('/department/delete', [App\Http\Controllers\DepartmentController::class, 'delete']);
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
