<?php

namespace App\Providers;

use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\Repositories\VacationRepository;
use App\Services\VacationService;
use Illuminate\Support\ServiceProvider;

class VacationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VacationService::class, VacationService::class);
        $this->app->bind(VacationRepositoryInterface::class, VacationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
