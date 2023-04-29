<?php

namespace ATPGroup\Districts;

use ATPGroup\Districts\Models\District;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Districts\Observers\DistrictObserver;
use ATPGroup\Districts\Views\Components\DropdownList;


class DistrictServiceProvider extends ServiceProvider
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
        District::observe(DistrictObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'district');
        $this->loadViewComponentsAs('district', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'district');
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
