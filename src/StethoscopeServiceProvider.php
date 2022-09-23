<?php

namespace MohsenAbrishami\Stethoscope;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use MohsenAbrishami\Stethoscope\Commands\StethoscopeCommand;
 
class StethoscopeServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/stethoscope.php' => config_path('stethoscope.php'),
        ]);
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                StethoscopeCommand::class,
            ]);
        }
    }
}