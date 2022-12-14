<?php

namespace MohsenAbrishami\Stethoscope;

use Illuminate\Support\ServiceProvider;
use MohsenAbrishami\Stethoscope\Commands\ListenCommand;
use MohsenAbrishami\Stethoscope\Commands\MonitorCommand;
use MohsenAbrishami\Stethoscope\LogRecord\LogManager;
use MohsenAbrishami\Stethoscope\Providers\EventServiceProvider;

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

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mohsenabrishami');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('record', function ($app) {
            return new LogManager($app);
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/stethoscope.php',
            'stethoscope'
        );

        $this->app->register(EventServiceProvider::class);
    }
}
