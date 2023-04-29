<?php

namespace ATPGroup\PricingLists;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use ATPGroup\PricingLists\Models\PricingList;
use ATPGroup\PricingLists\Livewire\CreatePricingLists;
use ATPGroup\PricingLists\Observers\PricingListObserver;

class PricingListServiceProvider extends ServiceProvider
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
        PricingList::observe(PricingListObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'pricingList');
        $this->loadViewComponentsAs('pricingList', $this->viewComponents());
        Livewire::component('create-pricing-lists', CreatePricingLists::class);
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'pricingList');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            //
        ];
    }
}
