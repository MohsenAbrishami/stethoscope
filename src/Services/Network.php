<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Network implements ServiceInterface
{
    public function check(): string
    {
        try {
            Http::get(config('stethoscope.network_monitor_url'))->successful();
            $networkConnction = 'connected';
        } catch (Exception $e) {
            $networkConnction = 'disconnected';
        }

        return $networkConnction;
    }
}
