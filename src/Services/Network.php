<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Network implements ServiceInterface
{
    public function check(): string
    {
        try {
            $networkConnction = Http::get(config('stethoscope.network_monitor_url'))->successful();
        } catch (Exception $e) {
            $networkConnction = 'false';
        }

        return $networkConnction;
    }
}
