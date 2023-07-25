<?php

use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Branch\SearchBranchController;
use App\Http\Controllers\BranchMaterialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\OrderStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

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
        Route::resource('staffs', StaffController::class);
        Route::resource('taxes', TaxController::class);
        Route::resource('products', ProductController::class);
        Route::resource('prices', PriceController::class);
        Route::resource('promotions', PromotionController::class);
        Route::resource('branch_materials', BranchMaterialController::class);

        Route::resource('suppliers', SupplierController::class);
        Route::resource('imports', ImportController::class);
        Route::get('orders-cheff', [OrderController::class, 'orderCheff'])->name('orders.orderCheff');
        Route::get('orders-cashier', [OrderController::class, 'orderCashier'])->name('orders.orderCashier');
        Route::get('add-orders', [OrderController::class, 'addOrder'])->name('orders.addOrder');
        Route::get('statistics', [StatisticController::class, 'index'])->name('statistics.index');

        Route::resource('sizes', SizeController::class);
        Route::resource('types', TypeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('uoms', UomController::class);
        Route::resource('branches', BranchController::class);
        Route::get('search-branch', [SearchBranchController::class, '__invoke']);
        Route::get('search-cus', [CustomerController::class, 'searchCustomer']);
        Route::post('add-cus', [CustomerController::class, 'addCustomer']);
        Route::post('update-order-status', [OrderStatusController::class, '__invoke']);
    });
});
