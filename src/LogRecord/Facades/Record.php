<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static LogRecordInterface getDefaultDriver()
 * @method static LogRecordInterface driver(string $name)
 * @method static LogManager extend(string $driver, \Closure $callback)
 * @method static mixed record(integer $cpuUsage, integer $memoryUsage, boolean $networkStatus, boolean $webServerStatuses, boolean $storageFreeSpace)
 */
class Record extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'record';
    }
}
