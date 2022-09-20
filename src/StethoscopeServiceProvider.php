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
        if ($this->app->runningInConsole()) {
            $this->commands([
                StethoscopeCommand::class,
            ]);
        }
    }
}