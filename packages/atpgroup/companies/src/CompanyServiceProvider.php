<?php

namespace ATPGroup\Companies;

use ATPGroup\Companies\Models\Company;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Companies\Observers\CompanyObserver;
use ATPGroup\Companies\Views\Components\DropdownBranch;
use ATPGroup\Companies\Views\Components\DropdownCompany;

class CompanyServiceProvider extends ServiceProvider
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
        Company::observe(CompanyObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'company');
        $this->loadViewComponentsAs('company', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'company');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            DropdownCompany::class,
            DropdownBranch::class,
        ];
    }
}
