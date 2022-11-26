<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;

class DataBaseDriver implements LogRecordInterface
{
    public function record($cpuUsage, $memoryUsage, $networkStatus, $webServerStatuses, $hardDiskFreeSpace)
    {
    }
}
