<?php

namespace App\Providers;

use App\CryptoApiRepositoryInterface;
use App\Repositories\CoinMarketCapRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CryptoApiRepositoryInterface::class, CoinMarketCapRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
