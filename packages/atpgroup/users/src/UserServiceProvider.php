<?php

namespace ATPGroup\Users;

use ATPGroup\Users\Models\User;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Users\Observers\UserObserver;

class UserServiceProvider extends ServiceProvider
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
        User::observe(UserObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'user');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'user');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
}
