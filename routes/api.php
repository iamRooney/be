<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SearchController;

// Route::apiResource('categories', CategoryController::class);
Route::apiResource('countries', CountryController::class);
Route::apiResource('states', StateController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('companies', CompanyController::class);

Route::get('/search', [SearchController::class, 'search']);
