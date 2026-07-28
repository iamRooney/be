<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\EnquiryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;

// Public APIs
Route::apiResource('countries', CountryController::class);
Route::apiResource('states', StateController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('categories', CategoryController::class);

Route::get('/search', [SearchController::class, 'search']);

// Buyer Auth APIs
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Admin APIs
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', DashboardController::class);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('services', ServiceController::class);
});

Route::prefix('auth')->group(function () {

    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// Authenticated Buyer APIs
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/enquiries', [EnquiryController::class, 'store']);
});

Route::apiResource('users', UserController::class)->only([
    'index',
    'show',
    'update',
    'destroy',
]);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/profile/complete', [ProfileController::class, 'complete']);
});
