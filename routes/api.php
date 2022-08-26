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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('transaction')->controller(\App\Http\Controllers\TransactionController::class)->group(function() {
    Route::post('/transferMoney', 'transferMoney');
    Route::get('/health', 'imOk');
});

Route::prefix('account')->controller(\App\Http\Controllers\AccountController::class)->group(function() {
    Route::post('/user', 'createUser');
    Route::post('/seller', 'createSeller');
    Route::get('/health', 'imOk');
});

