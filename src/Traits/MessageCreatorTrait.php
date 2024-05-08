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
        return "cpu usage ===> $cpuUsage %";
    }

    /**
     * Generate Storage free space message
     *
     * @param int
     * @return string
     */
    public function storageMessage($storageUsage)
    {
        return "storage free space ===> $storageUsage GB";
    }

    /**
     * Generate memory usage message
     *
     * @param int
     * @return string
     */
    public function memoryMessage($memoryUsage)
    {
        return "memory usage ===> $memoryUsage %";
    }

    /**
     * Generate network connection status message
     *
     * @param bool
     * @return string
     */
    public function networkMessage($networkStatus)
    {
        return "network connection status ===> $networkStatus";
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
