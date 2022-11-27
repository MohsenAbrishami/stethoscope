<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Contracts;

interface LogRecordInterface
{
    public function record($cpuUsage, $memoryUsage, $networkStatus, $webServerStatuses, $hardDiskFreeSpace);
}
