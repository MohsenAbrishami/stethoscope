<?php

namespace MohsenAbrishami\Stethoscope\Traits;

trait MessageCreatorTrait
{
    public function cpuMessage($cpuUsage)
    {
        return date('H:i:s') . ' ===> cpu uage: ' . number_format((float)$cpuUsage, 2, '.', '');
    }

    public function hardDiskMessage($hardDiskUsage)
    {
        return date('H:i:s') . " ===> hard disk free space: $hardDiskUsage Byte (" .
            number_format($hardDiskUsage / 1024 / 1024 / 1024, 2, '.', '') .  ' GB)';
    }

    public function memoryMessage($memoryUsage)
    {
        return date('H:i:s') . ' ===> memory uage: ' . number_format((float)$memoryUsage, 2, '.', '');
    }

    public function networkMessage($networkStatus)
    {
        return date('H:i:s') . ' ===> network connection status: ' . ($networkStatus ? 'connected' : 'not connected');
    }

    public function webServerMessage($webServerStatus)
    {
        return date('H:i:s') . ' ===> nginx status: ' . $webServerStatus;
    }
}
