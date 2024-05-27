<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Contracts;

interface LogRecordInterface
{
    public function record($logs);

    public function clean();
}
