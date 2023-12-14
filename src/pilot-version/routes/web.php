<?php

use Illuminate\Support\Facades\Route;

//管理画面系・マイページ系のファイル呼び出し
include __DIR__ . '/m_system_user.php';
include __DIR__ . '/m_user.php';

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
