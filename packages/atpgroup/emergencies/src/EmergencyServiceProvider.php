<?php

namespace ATPGroup\Emergencies;

use ATPGroup\Emergencies\Models\Emergency;
use Illuminate\Support\ServiceProvider;
use ATPGroup\Emergencies\Views\Components\DropdownEmergency;
use ATPGroup\Emergencies\Observers\EmergencyObserver;

class EmergencyServiceProvider extends ServiceProvider
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
        Emergency::observe(EmergencyObserver::class);

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'emergency');
        $this->loadViewComponentsAs('emergency', $this->viewComponents());
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'emergency');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
    protected function viewComponents(): array
    {
        return [
            DropdownEmergency::class,
        ];
    }
}
