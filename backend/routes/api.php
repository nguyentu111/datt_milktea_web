<?php

use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\StatisticController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', fn () => 'ok');
Route::post('auth/customer/register', [AuthCustomerController::class, 'register']);
Route::post('auth/customer/login', [AuthCustomerController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/customer/logout', [AuthCustomerController::class, 'logout']);
    Route::get('customer/{id}/addresses', [CustomerController::class, 'getAddresses']);
    Route::post('customer/{id}/addresses/add', [CustomerController::class, 'addAddress']);
    Route::post('customer/checkout', [OrderController::class, 'orderOnline']);
    Route::post('customer/add-favorite', [CustomerController::class, 'addFavorite']);
    Route::post('customer/remove-favorite', [CustomerController::class, 'removeFavorite']);
    Route::get('customer/favorite', [CustomerController::class, 'getFavorite']);
    Route::get('customer/order-history', [OrderController::class, 'getOrderHistory']);
});

Route::get('/drinks', [ProductController::class, 'getDrinks']);
Route::get('/branches', [BranchController::class, 'getBranches']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/statistics', [StatisticController::class, 'getStatistics']);
