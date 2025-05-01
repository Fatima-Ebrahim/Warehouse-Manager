<?php

namespace App\Providers;

use App\Models\Warehouse;
use App\Repositories\WarehouseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WarehouseRepository::class, function ($app) {
            return new WarehouseRepository(new Warehouse());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
