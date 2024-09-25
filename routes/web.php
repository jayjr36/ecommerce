<?php

use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;




Route::get('/', function () {
    return view('layouts.admin');
});

// These routes are for the admin to manage categories and products.
// They are both resource controllers, which means they will create
// the standard CRUD routes for each model.
//
// For example, the categories resource controller will create
// the following routes:
// - GET /categories (index)
// - GET /categories/create (create)
// - POST /categories (store)
// - GET /categories/{category} (show)
// - GET /categories/{category}/edit (edit)
// - PUT /categories/{category} (update)
// - DELETE /categories/{category} (destroy)
//
// Similarly, the products resource controller will create
// the standard CRUD routes for the products model.
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/my-orders', [CustomerController::class, 'myOrders'])->name('customer.orders');
Auth::routes();

Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Show the cart
//Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); // Add item to the cart
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove'); // Remove item from the cart
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); // Clear the cart
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard'); // Admin dashboard
Route::post('/admin/orders/{order}', [AdminController::class, 'updateStatus'])->name('admin.orders.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

