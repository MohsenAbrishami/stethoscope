<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Network implements ServiceInterface
{
    public function check(): string
    {
        foreach(config('stethoscope.network_monitor_url') as $networkMonitorURL){
            try {
                Http::get($networkMonitorURL)->successful();
                $networkConnction = 'connected';
                break;
            } catch (Exception $e) {
                $networkConnction = 'disconnected';
            }
        }

        return $networkConnction;
    }
}
