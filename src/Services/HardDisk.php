<?php

namespace MohsenAbrishami\Stethoscope\Services;

class HardDisk implements ServiceInterface
{
    public function monitor(string $log): string
    {
        $diskFreeSpace = diskfreespace('/');

        $message = date('H:i:s') . ' ===> hard disk free space: ' . $diskFreeSpace . " Byte (" .
            number_format($diskFreeSpace / 1024 / 1024 / 1024, 2, '.', '') .  " GB) \n";

        print_r($message);

        if ($diskFreeSpace < config(('stethoscope.thereshold.hard_disk')) && config('stethoscope.monitoring_enable.hard_disk'))
            $log .= $message;

        return $log;
    }
}
