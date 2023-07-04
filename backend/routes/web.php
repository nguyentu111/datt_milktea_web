<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\Customers\SearchCustomerController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\GoodsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\SearchUserController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::redirect('/', 'login');

Route::redirect('/dashboard', '/dashboard/home');

Route::prefix('dashboard')->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::fallback(function () {
            return view('pages/utility/404');
        });

        Route::get('home', [HomeController::class, 'index'])->name('home.index');

        Route::resource('users', UserController::class);

        Route::get('search-user', [SearchUserController::class, '__invoke']);

        Route::resource('customers', CustomerController::class);

        Route::get('search-customer', [SearchCustomerController::class, '__invoke']);

        Route::resource('imports', ImportController::class);

        Route::resource('exports', ExportController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('reservations', ReservationController::class);

        Route::resource('positions', PositionController::class);

        Route::resource('goods', GoodsController::class);
    });
});