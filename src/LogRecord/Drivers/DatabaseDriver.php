<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Models\ResourceLogs;

class DatabaseDriver implements LogRecordInterface
{
    public function record($resourceReports)
    {
        foreach ($resourceReports as $resource => $log) {
            ResourceLogs::insert([
                'resource' => $resource,
                'log' => $log
            ]);
        }
    }
}
