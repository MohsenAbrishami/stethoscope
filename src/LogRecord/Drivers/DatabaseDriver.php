<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;

class DatabaseDriver implements LogRecordInterface
{
    public function record($resourceLogs)
    {
        foreach ($resourceLogs as $resource => $log) {
            ResourceLog::create([
                'resource' => $resource,
                'log' => is_array($log) ? json_encode($log) : $log
            ]);
        }
    }

    public function clean()
    {
        ResourceLog::where('created_at', '<', now()->subDays(config('stethoscope.cleanup_resource_logs')))
            ->delete();
    }
}
