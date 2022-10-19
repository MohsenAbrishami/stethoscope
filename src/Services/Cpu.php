<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Cpu implements ServiceInterface
{
    public function monitor(string $log): string
    {
        $cpuUsage = exec(" grep 'cpu ' /proc/stat | awk '{print ($2+$4)*100/($2+$4+$5)}' ");

        $message = date('H:i:s') . ' ===> cpu uage: ' . number_format((float)$cpuUsage, 2, '.', '') . "% \n";

        print_r($message);

        if ($cpuUsage > config(('stethoscope.thereshold.cpu')) && config('stethoscope.monitoring_enable.cpu'))
            $log .= $message;

        return $log;
    }
}
