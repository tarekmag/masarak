<?php

namespace ATPGroup\Languages;

use ATPGroup\Languages\Models\Language;
use ATPGroup\Languages\Observers\LanguageObserver;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
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
        Language::observe(LanguageObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'language');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'language');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
}
