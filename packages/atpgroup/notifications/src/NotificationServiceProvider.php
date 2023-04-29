<?php

namespace ATPGroup\Notifications;

use Illuminate\Support\ServiceProvider;
use ATPGroup\Notifications\Views\Components\NotificationList;

class NotificationServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'notification');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'notification');
        $this->loadViewComponentsAs('notification', $this->viewComponents());
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    protected function viewComponents(): array
    {
        return [
            NotificationList::class,
        ];
    }
}
