<?php

namespace ATPGroup\Employees;

use ATPGroup\Employees\Models\Employee;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Employees\Observers\EmployeeObserver;
use ATPGroup\Employees\Views\Components\DropdownList;

class EmployeeServiceProvider extends ServiceProvider
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
        Employee::observe(EmployeeObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'employee');
        $this->loadViewComponentsAs('employee', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'employee');
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
