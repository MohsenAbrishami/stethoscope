<?php

namespace MohsenAbrishami\Stethoscope;

use Illuminate\Support\ServiceProvider;
use MohsenAbrishami\Stethoscope\Commands\ListenCommand;
use MohsenAbrishami\Stethoscope\Commands\MonitorCommand;

class StethoscopeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/stethoscope.php' => config_path('stethoscope.php'),
        ], 'stethoscope');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ListenCommand::class,
                MonitorCommand::class
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/stethoscope.php',
            'stethoscope'
        );
    }
}
