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

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');
//Route::get('/checkout/finish', [App\Http\Controllers\CheckoutController::class, 'finish'])->name('midtrans-finish');
//Route::get('/checkout/unfinish', [App\Http\Controllers\CheckoutController::class, 'unfinish'])->name('midtrans-unfinish');
//Route::get('/checkout/error', [App\Http\Controllers\CheckoutController::class, 'error'])->name('error');

Route::get('register/check', [App\Http\Controllers\Auth\RegisterController::class, 'check'])->name('api-register-check-success');
Route::get('provinces', [App\Http\Controllers\API\LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [App\Http\Controllers\API\LocationController::class, 'regencies'])->name('api-regencies');
