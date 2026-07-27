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

// Public APIs
Route::apiResource('countries', CountryController::class);
Route::apiResource('states', StateController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('categories', CategoryController::class);

Route::get('/search', [SearchController::class, 'search']);

// Admin APIs
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', DashboardController::class);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('services', ServiceController::class);
});

Route::post('/enquiries', [EnquiryController::class, 'store']);
