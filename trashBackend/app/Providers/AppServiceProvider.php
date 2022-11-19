<?php

namespace App\Providers;

use App\Interfaces\GeoCalculationServiceInterface;
use App\Services\GeoCalculationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GeoCalculationServiceInterface::class, GeoCalculationService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
