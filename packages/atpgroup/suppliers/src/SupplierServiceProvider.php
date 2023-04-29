<?php

namespace ATPGroup\Suppliers;

use ATPGroup\Suppliers\Models\Supplier;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Suppliers\Observers\SupplierObserver;
use ATPGroup\Suppliers\Views\Components\DropdownList;

class SupplierServiceProvider extends ServiceProvider
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
        Supplier::observe(SupplierObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'supplier');
        $this->loadViewComponentsAs('supplier', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'supplier');
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
