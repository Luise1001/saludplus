<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Reservations\Contracts\ReservationServiceInterface;
use App\Services\Reservations\ReservationService;
use App\Services\Patient\Contracts\PatientServiceInterface;
use App\Services\Patient\PatientService;
use App\Services\Locations\Contracts\LocationServiceInterface;
use App\Services\Locations\LocationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ReservationServiceInterface::class,
            ReservationService::class,
        );

        $this->app->bind(
            PatientServiceInterface::class,
            PatientService::class
        );

        $this->app->bind(
            LocationServiceInterface::class,
            LocationService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
