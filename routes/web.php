<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Guest Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('guest:admin')->group(function () {

        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('admin.login');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('admin.login.submit');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');

        // Categories CRUD
        Route::resource('categories', CategoryController::class)
            ->names('admin.categories');

        // Toggle Category Status
        Route::patch(
            'categories/{id}/toggle-status',
            [CategoryController::class, 'toggleStatus']
        )->name('admin.categories.toggle-status');
    });
});
