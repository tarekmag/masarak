<?php

namespace ATPGroup\Drivers;

use ATPGroup\Drivers\Models\Driver;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Drivers\Models\DriverDocument;
use ATPGroup\Drivers\Observers\DriverObserver;
use ATPGroup\Drivers\Views\Components\DropdownType;
use ATPGroup\Drivers\Views\Components\DropdownDriver;
use ATPGroup\Drivers\Observers\DriverDocumentObserver;
use ATPGroup\Drivers\Views\Components\DriverHtmlStatus;
use ATPGroup\Drivers\Views\Components\DropdownDocumentType;
use ATPGroup\Drivers\Views\Components\DropdownDocumentStatus;

class DriverServiceProvider extends ServiceProvider
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
        Driver::observe(DriverObserver::class);
        DriverDocument::observe(DriverDocumentObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'driver');
        $this->loadViewComponentsAs('driver', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'driver');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            DropdownDriver::class,
            DropdownType::class,
            DropdownDocumentStatus::class,
            DropdownDocumentType::class,
            DriverHtmlStatus::class,
        ];
    }
}
