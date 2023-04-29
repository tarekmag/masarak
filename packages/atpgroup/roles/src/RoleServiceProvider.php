<?php

namespace ATPGroup\Roles;

use ATPGroup\Roles\Models\Role;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Roles\Observers\RoleObserver;
use ATPGroup\Roles\Views\Components\DropdownList;

class RoleServiceProvider extends ServiceProvider
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
        Role::observe(RoleObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'role');
        $this->loadViewComponentsAs('role', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'role');
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
