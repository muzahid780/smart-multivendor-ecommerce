<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Web Routes
// Home
Route::get('/', function () {
    return view('welcome');
});

// ADMIN ROUTES
Route::middleware(['auth', 'admin'])->group(function () {
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
    ->name('orders.status');
    Route::get('/admin/orders/pdf', [OrderController::class, 'exportPdf'])
    ->name('orders.pdf');

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Products
    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/admin/products/{id}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    // Orders
    Route::get('/admin/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/admin/orders/create', [OrderController::class, 'create'])
        ->name('orders.create');

    Route::post('/admin/orders', [OrderController::class, 'store'])
        ->name('orders.store');
});

// VENDOR ROUTES
Route::middleware(['auth', 'vendor'])->group(function () {

    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])
        ->name('vendor.dashboard');
});

// USER DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// PROFILE ROUTES
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';