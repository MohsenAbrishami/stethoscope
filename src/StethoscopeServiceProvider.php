<?php

namespace MohsenAbrishami\Stethoscope;

use Illuminate\Support\ServiceProvider;
use MohsenAbrishami\Stethoscope\Commands\CleanupCommand;
use MohsenAbrishami\Stethoscope\Commands\ListenCommand;
use MohsenAbrishami\Stethoscope\Commands\MonitorCommand;
use MohsenAbrishami\Stethoscope\Http\Middleware\CheckAccessToMonitoringPanel;
use MohsenAbrishami\Stethoscope\LogRecord\LogManager;
use MohsenAbrishami\Stethoscope\Providers\EventServiceProvider;

class StethoscopeServiceProvider extends ServiceProvider
{
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
            __DIR__.'/../config/stethoscope.php',
            'stethoscope'
        );

        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // publishing the config
            $this->publishes([
                __DIR__.'/../config/stethoscope.php' => config_path('stethoscope.php'),
            ], 'stethoscope-publish-config');

            // publishing the build files
            $this->publishes([
                __DIR__.'/../public/build' => public_path('vendor/stethoscope'),
            ], 'stethoscope-publish-view');

            $this->commands([
                ListenCommand::class,
                MonitorCommand::class,
                CleanupCommand::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mohsenabrishami');

        $this->app['router']->aliasMiddleware('check.access.to.monitoring.panel', CheckAccessToMonitoringPanel::class);
    }
}
