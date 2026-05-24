<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorOrderController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', [ProductController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| SHOP SYSTEM (FINAL FIXED)
|--------------------------------------------------------------------------
*/

// SHOP PAGE
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

// SEARCH (category + product search)
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

// PRODUCT DETAILS
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.details');


/*
|--------------------------------------------------------------------------
| CATEGORY ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');


/*
|--------------------------------------------------------------------------
| CART ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('cart')->name('cart.')->group(function () {

    Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('add');

    Route::get('/', [CartController::class, 'cartPage'])->name('page');

    Route::post('/update/{id}', [CartController::class, 'updateCart'])->name('update');

    Route::post('/remove/{id}', [CartController::class, 'removeCart'])->name('remove');

    Route::post('/clear', [CartController::class, 'clearCart'])->name('clear');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');

    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| ORDER SUCCESS
|--------------------------------------------------------------------------
*/

Route::get('/order-success', function () {
    return view('frontend.success');
})->name('order.success');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/{id}', [OrderController::class, 'showAdmin'])->name('orders.show');

    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});


/*
|--------------------------------------------------------------------------
| VENDOR PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('vendor')->name('vendor.')->middleware(['auth', 'vendor'])->group(function () {

    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

    Route::resource('products', VendorProductController::class);

    Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/{id}', [VendorOrderController::class, 'show'])->name('orders.show');

    Route::patch('/orders/{id}/status', [VendorOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';