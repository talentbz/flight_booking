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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register'])->name('api.register');
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login'])->name('api.login');
Route::post('/user-store', [App\Http\Controllers\API\UserController::class, 'store'])->name('api.user.store');
Route::prefix('/paystack')->group(function () {
    Route::post('/pay', [App\Http\Controllers\API\PaystackController::class, 'redirectToGateway'])->name('api.paystack.pay');
    Route::get('/callback', [App\Http\Controllers\API\PaystackController::class, 'handleGatewayCallback'])->name('api.paystack.controll');
});