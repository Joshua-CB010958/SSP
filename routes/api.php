<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// API Routes for Products
Route::prefix('products')->group(function () {
 
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'save']);
    Route::get('{id}', [ProductController::class, 'show']);
    Route::put('{id}', [ProductController::class, 'update']);
    Route::delete('{id}', [ProductController::class, 'destroy']);

});

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Routes (only for authenticated users)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', HomeController::class)->only(['index', 'show']);
});


//returning the JSON data for the API
Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/count', [ProductController::class, 'count']);
Route::get('/customers/count', [ProductController::class, 'customerCount']);
Route::get('/customers/countries', [ProductController::class, 'customerCountries']);



