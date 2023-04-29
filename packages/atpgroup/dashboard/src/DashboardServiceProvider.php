<?php

namespace ATPGroup\Dashboard;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'dashboard');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'dashboard');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
}
