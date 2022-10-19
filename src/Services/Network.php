<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Network implements ServiceInterface
{
    public function monitor(string $log): string
    {
        try {
            Http::get(config('stethoscope.network-monitor-url'))->successful();
            $networkConnction = 'connected';
        } catch (Exception $e) {
            $networkConnction = 'not connected';
        }

        $message = date('H:i:s') . ' ===> network connection status: ' . $networkConnction . "\n";

        print_r($message);

        if (!$networkConnction && config('stethoscope.monitoring_enable.network'))
            $log .= $message;

        return $log;
    }
}
