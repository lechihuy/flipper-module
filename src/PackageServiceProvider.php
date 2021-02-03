<?php

namespace Flipper\Module;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    const PREFIX_MODULE_NAME = 'modules';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerHelpers();

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
        }
    }

    /**
     * Register the console commands for the package.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands([
            \Flipper\Module\Commands\CreateModule::class,
            \Flipper\Module\Commands\DeleteModule::class,
        ]);
    }

    protected function registerHelpers()
    {
        require 'helpers.php';
    }
}
