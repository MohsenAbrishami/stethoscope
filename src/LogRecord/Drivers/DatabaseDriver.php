<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;

class DatabaseDriver implements LogRecordInterface
{
    public function record($logs)
    {
        foreach ($logs as $resource => $log) {
            ResourceLog::create([
                'resource' => $resource,
                'log' => $log,
            ]);
        }
    }

    public function clean()
    {
        ResourceLog::where('created_at', '<', now()->subDays(config('stethoscope.cleanup_resource_logs')))
            ->delete();
    }
}
