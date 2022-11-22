<?php

use Illuminate\Support\Manager;
use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;

class LogManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return config('stethoscope.drivers.log');
    }
    /**
     * Get an instance of the log driver.
     *
     * @return LogRecordInterface
     */
    public function createLogDriver(): LogRecordInterface
    {
        return new LogRecordInterface();
    }
}
