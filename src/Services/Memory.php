<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Memory
{
    public function index()
    {
        if (!config('stethoscope.monitoring_enable.memory'))
            return null;

        $memoryUsage = exec(" free | grep Mem | awk '{print $3/$2 * 100.0}' ");

        $message = date('H:i:s') . " ===> memory uage:  $memoryUsage \n";

        print_r($message);

        if ($memoryUsage > config(('stethoscope.thereshold.memory')))
            $log .= $message;

        return $log;
    }
}
