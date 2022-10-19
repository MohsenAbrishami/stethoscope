<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Network implements ServiceInterface
{
    public function monitor(string $log): string
    {
        try {
            $networkConnction = Http::get(config('stethoscope.network-monitor-url'))->successful();
        } catch (Exception $e) {
            $networkConnction = false;
        }

        $message = date('H:i:s') . ' ===> network connection status: ' . ($networkConnction ? 'connected' : 'not connected') . "\n";

        print_r($message);

        if (!$networkConnction && config('stethoscope.monitoring_enable.network'))
            $log .= $message;

        return $log;
    }
}
