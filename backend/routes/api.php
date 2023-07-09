<?php

use App\Http\Controllers\AuthCustomerController;
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
});
