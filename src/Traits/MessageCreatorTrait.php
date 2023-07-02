<?php

namespace MohsenAbrishami\Stethoscope\Traits;

trait MessageCreatorTrait
{
    /**
     * Generate log time message
     *
     * @return string
     */
    public function timeMessage()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Generate CPU usage message
     *
     * @param int
     * @return string
     */
    public function cpuMessage($cpuUsage)
    {
        return 'cpu usage ===> '.number_format((float) $cpuUsage, 2, '.', '').'%';
    }

    /**
     * Generate hard disk free space message
     *
     * @param int
     * @return string
     */
    public function hardDiskMessage($hardDiskUsage)
    {
        return "hard disk free space ===> $hardDiskUsage Byte (".
            number_format($hardDiskUsage / 1024 / 1024 / 1024, 2, '.', '').' GB)';
    }

    /**
     * Generate memory usage message
     *
     * @param int
     * @return string
     */
    public function memoryMessage($memoryUsage)
    {
        return 'memory usage ===> '.number_format((float) $memoryUsage, 2, '.', '').'%';
    }

    /**
     * Generate network connection status message
     *
     * @param bool
     * @return string
     */
    public function networkMessage($networkStatus)
    {
        return 'network connection status ===> '.($networkStatus == 'false' ? 'not connected' : 'connected');
    }

    /**
     * Generate web server status message
     *
     * @param string
     * @return string
     */
    public function webServerMessage($webServerStatus)
    {
        return 'web server status ===> '.$webServerStatus;
    }
}
