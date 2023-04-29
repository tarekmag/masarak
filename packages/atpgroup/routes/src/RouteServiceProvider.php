<?php

namespace ATPGroup\Routes;

use Livewire\Livewire;
use ATPGroup\Routes\Models\Trip;
use ATPGroup\Routes\Models\Route;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Routes\Observers\TripObserver;
use ATPGroup\Routes\Observers\RouteObserver;
use ATPGroup\Routes\Livewire\TripsTableComponent;
use ATPGroup\Routes\Views\Components\DropdownTrip;
use ATPGroup\Routes\Views\Components\DropdownType;
use ATPGroup\Routes\Views\Components\ListWeekdays;
use ATPGroup\Routes\Views\Components\DropdownRoute;
use ATPGroup\Routes\Views\Components\TripHtmlStatus;
use ATPGroup\Routes\Livewire\AssignedEmployeeComponent;
use ATPGroup\Routes\Views\Components\DropdownTripStatus;
use ATPGroup\Routes\Views\Components\DropdownScheduleType;
use ATPGroup\Routes\Views\Components\EmployeeLocationRequestsStatus;
use ATPGroup\Routes\Views\Components\DropdownLocationEmployeeRequestStatus;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Observe
        Route::observe(RouteObserver::class);
        Trip::observe(TripObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'route');
        $this->loadViewComponentsAs('route', $this->viewComponents());
        Livewire::component('trips-table', TripsTableComponent::class);
        Livewire::component('assigned-employee', AssignedEmployeeComponent::class);
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'route');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            DropdownRoute::class,
            DropdownType::class,
            DropdownScheduleType::class,
            ListWeekdays::class,
            DropdownLocationEmployeeRequestStatus::class,
            TripHtmlStatus::class,
            EmployeeLocationRequestsStatus::class,
            DropdownTrip::class,
            DropdownTripStatus::class,
        ];
    }
}
