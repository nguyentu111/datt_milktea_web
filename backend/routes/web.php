<?php

use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Branch\SearchBranchController;
use App\Http\Controllers\BranchMaterialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
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
use App\Models\Supplier;
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

        Route::resource('sizes', SizeController::class);
        Route::resource('types', TypeController::class);
        Route::resource('uoms', UomController::class);
        Route::resource('branches', BranchController::class);
        Route::get('search-branch', [SearchBranchController::class, '__invoke']);
    });
});
