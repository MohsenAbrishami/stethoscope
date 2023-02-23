<?php

namespace MohsenAbrishami\Stethoscope;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use MohsenAbrishami\Stethoscope\Commands\ListenCommand;
use MohsenAbrishami\Stethoscope\Commands\MonitorCommand;
use MohsenAbrishami\Stethoscope\Commands\CleanupCommand;
use MohsenAbrishami\Stethoscope\Exceptions\InvalidHardDisksConfigException;
use MohsenAbrishami\Stethoscope\LogRecord\LogManager;
use MohsenAbrishami\Stethoscope\Providers\EventServiceProvider;

class StethoscopeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     * @throws InvalidHardDisksConfigException
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/stethoscope.php' => config_path('stethoscope.php'),
        ], 'stethoscope');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ListenCommand::class,
                MonitorCommand::class,
                CleanupCommand::class
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mohsenabrishami');

        try {
            Validator::make(config("stethoscope.hard_disks"), [
                '*.path' => 'required|string',
                '*.threshold' => 'required|integer'
            ], [
                '*.path.required' => 'The path is required',
                '*.path.string' => 'The path must be a string',
                '*.threshold.required' => 'The threshold is required',
                '*.threshold.integer' => 'The threshold must be an integer'
            ])->validate();
        }catch (ValidationException $exception){
            throw new InvalidHardDisksConfigException($exception->getMessage());
        }
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
