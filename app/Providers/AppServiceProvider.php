<?php

namespace App\Providers;

use App\Services\PostService;
use App\Interfaces\PostInterface;
use App\Services\SubscriptionService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\SubscriptionInterface;
use App\Interfaces\WebsiteInterface;
use App\Services\WebSiteService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PostInterface::class, PostService::class);
        $this->app->singleton(SubscriptionInterface::class, SubscriptionService::class);
        $this->app->singleton(WebsiteInterface::class, WebSiteService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}