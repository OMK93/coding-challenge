<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SettingController;
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

Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('orders', OrderController::class)->name('orders.store');
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
