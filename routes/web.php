<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes for managing products
Route::middleware(App\Http\Middleware\AdminRoleMiddleware::class)->group(function() {
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('product/save', [App\Http\Controllers\ProductController::class, 'save'])->name('product.save');
});

// Regular routes for viewing products
Route::get('/products', [ProductController::class, 'home'])->name('products.home');

// API route for fetching products (to be used by Axios)
Route::get('/products/data', [ProductController::class, 'getProducts'])->name('products.data');
// Route for displaying the product list
Route::get('/product/index', [ProductController::class, 'index'])->name('products.index');
Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/count', [ProductController::class, 'count']);
Route::get('/customers/count', [ProductController::class, 'customerCount']);
Route::get('/customers/countries', [ProductController::class, 'customerCountries']);

Route::get('/cart', function () {
    return view('cart');
});

