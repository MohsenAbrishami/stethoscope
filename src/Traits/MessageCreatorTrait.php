<?php

namespace MohsenAbrishami\Stethoscope\Traits;

trait MessageCreatorTrait
{
    public function timeMessage()
    {
        return date('Y-m-d H:i:s');
    }

    public function cpuMessage($cpuUsage)
    {
        return 'cpu usage ===> ' . number_format((float)$cpuUsage, 2, '.', '') . '%';
    }

    public function hardDiskMessage($hardDiskUsage)
    {
        return "hard disk free space ===> $hardDiskUsage Byte (" .
            number_format($hardDiskUsage / 1024 / 1024 / 1024, 2, '.', '') .  ' GB)';
    }

    public function memoryMessage($memoryUsage)
    {
        return 'memory usage ===> ' . number_format((float)$memoryUsage, 2, '.', '') . '%';
    }

    public function networkMessage($networkStatus)
    {
        return 'network connection status ===> ' . ($networkStatus ? 'connected' : 'not connected');
    }

    public function webServerMessage($webServerStatus)
    {
        return 'nginx status ===> ' . $webServerStatus;
    }
}
