<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Network
{
    public function index()
    {
        if (!config('stethoscope.monitoring_enable.network'))
            return null;

        try {
            $networkConnction = Http::get('www.google.com')->successful();
        } catch (Exception $e) {
            $networkConnction = 'false';
        }

        $message = date('H:i:s') . " ===> network connection:  $networkConnction \n";

        print_r($message);

        if (!$networkConnction)
            $log .= $message;

        return $log;
    }
}
