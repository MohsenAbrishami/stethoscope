<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;

class DatabaseDriver implements LogRecordInterface
{
    public function record($resourceLogs)
    {
        foreach ($resourceLogs as $resource => $log) {
            ResourceLog::insert([
                'resource' => $resource,
                'log' => $log
            ]);
        }
    }
}
