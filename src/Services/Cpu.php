<?php

namespace MohsenAbrishami\Stethoscope\Services;

class Cpu
{
    public function index()
    {
        if (!config('stethoscope.monitoring_enable.cpu'))
            return null;

        $cpuUsage = exec(" grep 'cpu ' /proc/stat | awk '{print ($2+$4)*100/($2+$4+$5)}' ");

        $message = date('H:i:s') . " ===> cpu uage:  $cpuUsage \n";

        print_r($message);

        if ($cpuUsage > config(('stethoscope.thereshold.cpu')))
            $log .= $message;

        return $log;
    }
}
