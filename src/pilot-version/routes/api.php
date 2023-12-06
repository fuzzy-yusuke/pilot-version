<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthAdminController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 認証なしで叩けるAPI
Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
});

// 認証ありで叩けるAPI
Route::group(['prefix' => 'auth', 'middleware' => ['jwt.role:api', 'jwt.auth']], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

// 認証なしで叩けるAPI
Route::group(['prefix' => 'admin'], function ($router) {
    Route::post('login', [AuthAdminController::class, 'login']);
});

// 認証ありで叩けるAPI
Route::group(['prefix' => 'admin', 'middleware' => ['jwt.role:admin-api', 'jwt.auth']], function ($router) {
    Route::post('logout', [AuthAdminController::class, 'logout']);
    Route::post('refresh', [AuthAdminController::class, 'refresh']);
    Route::get('me', [AuthAdminController::class, 'me']);
});
