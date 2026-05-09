<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
 use App\Http\Controllers\CheckoutController;

// ================= HOME =================
Route::get('/', function () {
    return view('welcome');
});

// ================= FRONTEND ROUTES =================

// Category Wise Products
Route::get('/category/{slug}', [ProductController::class, 'categoryProducts'])
    ->name('category.products');

// Product Details
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.details');


// ================= CHECKOUT =================

// Checkout page
Route::get('/checkout', [CheckoutController::class, 'checkout'])
    ->name('checkout.page');

// Place order
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])
    ->name('place.order');

// ================= CART =================

// Add to cart
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])
    ->name('cart.add');

// Cart page
Route::get('/cart', [CartController::class, 'cartPage'])
    ->name('cart.page');

// Remove item
Route::delete('/cart/remove/{id}', [CartController::class, 'removeCart'])
    ->name('cart.remove');

// Update quantity
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])
    ->name('cart.update');


// ================= ADMIN ROUTES =================
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // ================= PRODUCTS =================

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

    // ================= CATEGORIES =================

    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/admin/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    // ================= ORDERS =================

    Route::get('/admin/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/admin/orders/create', [OrderController::class, 'create'])
        ->name('orders.create');

    Route::post('/admin/orders', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.status');

    Route::get('/admin/orders/pdf', [OrderController::class, 'exportPdf'])
        ->name('orders.pdf');
});


// ================= VENDOR ROUTES =================
Route::middleware(['auth', 'vendor'])->group(function () {

    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])
        ->name('vendor.dashboard');
});


// ================= USER DASHBOARD =================
Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware(['auth', 'verified'])
  ->name('dashboard');


// ================= PROFILE ROUTES =================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ================= AUTH =================
require __DIR__.'/auth.php';