<?php

namespace ATPGroup\Stations;

use ATPGroup\Stations\Models\Station;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Stations\Observers\StationObserver;
use ATPGroup\Stations\Views\Components\DropdownList;

class StationServiceProvider extends ServiceProvider
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
        Station::observe(StationObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'station');
        $this->loadViewComponentsAs('station', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'station');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            DropdownList::class,
        ];
    }
}
