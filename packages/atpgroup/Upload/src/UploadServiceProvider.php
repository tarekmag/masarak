<?php

namespace ATPGroup\Upload;

use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
		$this->app->make('ATPGroup\Upload\Upload');
        $this->loadViewsFrom(__DIR__.'/views', 'Upload');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
