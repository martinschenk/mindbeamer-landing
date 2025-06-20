<?php

namespace App\Providers;

use App\Services\CookieConsentService;
use App\Services\LocaleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LocaleService::class, function ($app) {
            return new LocaleService();
        });
        
        $this->app->singleton(CookieConsentService::class, function ($app) {
            return new CookieConsentService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
