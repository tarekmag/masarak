<?php

namespace ATPGroup\BrandModels;

use Illuminate\Support\ServiceProvider;
use ATPGroup\BrandModels\Models\BrandModel;
use ATPGroup\BrandModels\Observers\BrandModelObserver;
use ATPGroup\BrandModels\Views\Components\DropdownList;

class BrandModelServiceProvider extends ServiceProvider
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
        BrandModel::observe(BrandModelObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'brandModel');
        $this->loadViewComponentsAs('brandModel', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'brandModel');
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
