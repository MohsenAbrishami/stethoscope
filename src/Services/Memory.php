<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Memory implements ServiceInterface
{
    public function monitor(string $log): string
    {
        $memoryUsage = exec(" free | grep Mem | awk '{print $3/$2 * 100.0}' ");

        $message = date('H:i:s') . ' ===> memory uage:  ' . number_format((float)$memoryUsage, 2, '.', '') . "% \n";

        print_r($message);

        if ($memoryUsage > config(('stethoscope.thereshold.memory')) && config('stethoscope.monitoring_enable.memory'))
            $log .= $message;

        return $log;
    }
}
