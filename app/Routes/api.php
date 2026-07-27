<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\ProductController;

Route::prefix('admin')
    ->middleware(['auth:sanctum'])
    ->group(function () {

        Route::get('/dashboard', DashboardController::class);

        Route::apiResource('products', ProductController::class);
    });
