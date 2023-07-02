<?php

namespace MohsenAbrishami\Stethoscope\LogRecord;

use Illuminate\Support\Manager;
use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\LogRecord\Drivers\DatabaseDriver;
use MohsenAbrishami\Stethoscope\LogRecord\Drivers\FileDriver;

class LogManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return config('stethoscope.drivers.log_record');
    }

    /**
     * Get an instance of the log driver.
     */
    public function createFileDriver(): LogRecordInterface
    {
        return new FileDriver();
    }

    /**
     * Get an instance of the log driver.
     */
    public function createDatabaseDriver(): LogRecordInterface
    {
        return new DatabaseDriver();
    }
}
