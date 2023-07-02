<?php

namespace MohsenAbrishami\Stethoscope\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use MohsenAbrishami\Stethoscope\Events\TroubleOccurred;
use MohsenAbrishami\Stethoscope\Listeners\SendResourceLogNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TroubleOccurred::class => [
            SendResourceLogNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
