<?php

namespace ATPGroup\Brands;

use ATPGroup\Brands\Models\Brand;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Brands\Observers\BrandObserver;
use ATPGroup\Brands\Views\Components\DropdownList;

class BrandServiceProvider extends ServiceProvider
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
        Brand::observe(BrandObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'brand');
        $this->loadViewComponentsAs('brand', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'brand');
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
