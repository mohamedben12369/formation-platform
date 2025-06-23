<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        // Register footer component
        Blade::component('footer', \App\View\Components\Footer::class);
        
        // Set default pagination template for bootstrap 5
        \Illuminate\Pagination\Paginator::useBootstrap();
        
        // You can uncomment the line below to use our custom compact pagination template globally
        // \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.bootstrap-4-compact');
    }
}
