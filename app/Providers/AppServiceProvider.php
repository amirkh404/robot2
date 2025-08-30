<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Point\PointServiceInterface;
use App\Services\Point\PointService;
use App\Services\Sms\SmsServiceInterface;
use App\Services\Sms\KavenegarService;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\AI\AIServiceInterface;
use App\Services\AI\AvalAIService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(PointServiceInterface::class, PointService::class);
        $this->app->bind(SmsServiceInterface::class, KavenegarService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(AIServiceInterface::class, AvalAIService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
