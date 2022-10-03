<?php

namespace MohsenAbrishami\Stethoscope\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Network
{
    public function index(string $log)
    {
        try {
            $networkConnction = Http::get('www.google.com')->successful();
        } catch (Exception $e) {
            $networkConnction = 'false';
        }

        $message = date('H:i:s') . " ===> network connection:  $networkConnction \n";

        print_r($message);

        if (!$networkConnction && !config('stethoscope.monitoring_enable.network'))
            $log .= $message;

        return $log;
    }
}
