<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // The admin panel is built on Bootstrap 5, but Laravel's default
        // paginator view is styled for Tailwind CSS. Since Tailwind isn't
        // loaded in this app, ->links() rendered unstyled/duplicated
        // markup. This makes all paginators (categories, companies,
        // users, enquiries, products, services) render Bootstrap 5
        // markup instead, matching the .pagination/.page-link CSS
        // already used across the admin views.
        Paginator::useBootstrapFive();
    }
}
