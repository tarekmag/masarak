<?php

namespace ATPGroup\Vehicles;

use ATPGroup\Vehicles\Models\Vehicle;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Vehicles\Models\VehicleDocument;
use ATPGroup\Vehicles\Observers\VehicleObserver;
use ATPGroup\Vehicles\Views\Components\DropdownVehicle;
use ATPGroup\Vehicles\Observers\VehicleDocumentObserver;
use ATPGroup\Vehicles\Views\Components\DropdownDocumentType;
use ATPGroup\Vehicles\Views\Components\DropdownDocumentStatus;

class VehicleServiceProvider extends ServiceProvider
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
        Vehicle::observe(VehicleObserver::class);
        VehicleDocument::observe(VehicleDocumentObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'vehicle');
        $this->loadViewComponentsAs('vehicle', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'vehicle');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            DropdownVehicle::class,
            DropdownDocumentStatus::class,
            DropdownDocumentType::class,
        ];
    }
}
