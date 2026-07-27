<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;

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

        Route::resource('companies', CompanyController::class)
            ->names('admin.companies');

        Route::resource('users', UserController::class)
            ->names('admin.users');

        Route::resource('enquiries', EnquiryController::class)
            ->names('admin.enquiries');

        Route::prefix('listings')->name('admin.listings.')->group(function () {

            Route::resource('products', ProductController::class);

            Route::patch(
                'products/{product}/approve',
                [ProductController::class, 'approve']
            )->name('products.approve');

            Route::patch(
                'products/{product}/reject',
                [ProductController::class, 'reject']
            )->name('products.reject');

            Route::patch(
                'products/{product}/feature',
                [ProductController::class, 'toggleFeatured']
            )->name('products.feature');

            Route::resource('services', ServiceController::class);
        });

        // Toggle Category Status
        Route::patch(
            'categories/{id}/toggle-status',
            [CategoryController::class, 'toggleStatus']
        )->name('admin.categories.toggle-status');
    });
});
