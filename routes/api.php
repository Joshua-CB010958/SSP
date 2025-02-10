<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController; // Add this line

// API Routes for Products
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'save']);
    Route::get('{id}', [ProductController::class, 'show']); // Fetch a single product by ID
    Route::put('{id}', [ProductController::class, 'update']);
    Route::delete('{id}', [ProductController::class, 'destroy']);
});

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);

// Routes for authenticated users
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', HomeController::class)->only(['index', 'show']);
    Route::get('/user', [UserController::class, 'show']); // Fetch authenticated user's data
});

// Additional product routes
Route::get('/products/count', [ProductController::class, 'count']);
Route::get('/customers/count', [ProductController::class, 'customerCount']);
Route::get('/customers/countries', [ProductController::class, 'customerCountries']);
Route::get('app/products', [ProductController::class, 'getAppProducts']);



