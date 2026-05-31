<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        View::composer(['welcome', 'welcome.*', 'blog.show'], function ($view): void {
            if (! array_key_exists('siteSettings', $view->getData())) {
                $view->with('siteSettings', Setting::settings());
            }
        });
    }
}
