<?php

use Courier\Console\Commands\StethoscopeCommand;
 
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