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
use App\Http\Controllers\Admin\CompanyDocumentController as AdminCompanyDocumentController;

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

        Route::patch(
            'companies/{company}/toggle-verified',
            [CompanyController::class, 'toggleVerified']
        )->name('admin.companies.toggle-verified');

        Route::get(
            'companies/documents/{document}',
            [AdminCompanyDocumentController::class, 'show']
        )->name('admin.companies.documents.show');

        Route::patch(
            'companies/documents/{document}/approve',
            [AdminCompanyDocumentController::class, 'approve']
        )->name('admin.companies.documents.approve');

        Route::patch(
            'companies/documents/{document}/reject',
            [AdminCompanyDocumentController::class, 'reject']
        )->name('admin.companies.documents.reject');

        Route::resource('users', UserController::class)
            ->names('admin.users');

        Route::patch(
            'users/{user}/toggle-status',
            [UserController::class, 'toggleStatus']
        )->name('admin.users.toggle-status');

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

            Route::patch(
                'services/{service}/approve',
                [ServiceController::class, 'approve']
            )->name('services.approve');

            Route::patch(
                'services/{service}/reject',
                [ServiceController::class, 'reject']
            )->name('services.reject');

            Route::patch(
                'services/{service}/feature',
                [ServiceController::class, 'toggleFeatured']
            )->name('services.feature');
        });

        // Toggle Category Status
        Route::patch(
            'categories/{id}/toggle-status',
            [CategoryController::class, 'toggleStatus']
        )->name('admin.categories.toggle-status');
    });
});
