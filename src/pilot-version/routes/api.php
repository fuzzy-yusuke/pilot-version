<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post("login", [AuthController::class, 'login']);
});

// 認証ありで叩けるAPI
Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
    Route::get('me', [AuthController::class, 'me']);
});
