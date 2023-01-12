<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Contracts;

interface LogRecordInterface
{
    public function record($resourceLogs);

    public function clean();
}
