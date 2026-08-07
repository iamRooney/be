<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Api\Admin\CompanyDocumentController as AdminCompanyDocumentController;
use App\Http\Controllers\Api\EnquiryController;
use App\Http\Controllers\Api\SavedCompanyController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProductController as SellerProductController;
use App\Http\Controllers\Api\CompanyDocumentController;

// Public APIs (read-only)
Route::apiResource('countries', CountryController::class);
Route::apiResource('states', StateController::class);
Route::apiResource('cities', CityController::class);

Route::apiResource('companies', CompanyController::class)->only([
    'index',
]);
Route::get('/companies/{slug}', [CompanyController::class, 'show']);

Route::apiResource('categories', CategoryController::class)->only([
    'index',
    'show'
]);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show']);

Route::get('/search', [SearchController::class, 'search']);

// Admin APIs
Route::prefix('admin')->group(function () {

    // Admin login is the only unauthenticated admin endpoint
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        Route::get('/me', [AdminAuthController::class, 'me']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);

        Route::get('/dashboard', DashboardController::class);

        Route::apiResource('products', ProductController::class);
        Route::patch('products/{product}/approve', [ProductController::class, 'approve']);
        Route::patch('products/{product}/reject', [ProductController::class, 'reject']);
        Route::patch('products/{product}/feature', [ProductController::class, 'toggleFeatured']);

        Route::apiResource('services', ServiceController::class);
        Route::patch('services/{service}/approve', [ServiceController::class, 'approve']);
        Route::patch('services/{service}/reject', [ServiceController::class, 'reject']);
        Route::patch('services/{service}/feature', [ServiceController::class, 'toggleFeatured']);

        Route::apiResource('enquiries', AdminEnquiryController::class)->only([
            'index',
            'show',
            'update',
            'destroy'
        ]);

        Route::get('documents', [AdminCompanyDocumentController::class, 'index']);
        Route::get('documents/{document}', [AdminCompanyDocumentController::class, 'show']);
        Route::patch('documents/{document}/approve', [AdminCompanyDocumentController::class, 'approve']);
        Route::patch('documents/{document}/reject', [AdminCompanyDocumentController::class, 'reject']);
    });
});

// Write access to companies/categories and all user management
// is admin-only, kept on their original top-level paths.
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::apiResource('companies', CompanyController::class)->only([
        'store',
        'update',
        'destroy'
    ]);

    Route::apiResource('categories', CategoryController::class)->only([
        'store',
        'update',
        'destroy'
    ]);

    Route::apiResource('users', UserController::class)->only([
        'index',
        'show',
        'update',
        'destroy',
    ]);
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

    Route::get('/enquiries', [EnquiryController::class, 'index']);
    Route::post('/enquiries', [EnquiryController::class, 'store']);

    Route::get('/saved-companies', [SavedCompanyController::class, 'index']);
    Route::post('/saved-companies', [SavedCompanyController::class, 'store']);
    Route::delete('/saved-companies/{company}', [SavedCompanyController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/profile/complete', [ProfileController::class, 'complete']);
});

// Authenticated Seller APIs (manage their own company's products)
Route::middleware('auth:sanctum')->prefix('seller')->name('seller.')->group(function () {

    Route::apiResource('products', SellerProductController::class)->except(['show']);

    Route::get('company/documents', [CompanyDocumentController::class, 'index']);
    Route::post('company/documents', [CompanyDocumentController::class, 'store']);
    Route::get('company/documents/{document}', [CompanyDocumentController::class, 'show']);
    Route::delete('company/documents/{document}', [CompanyDocumentController::class, 'destroy']);
});
