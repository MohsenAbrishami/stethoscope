<?php

namespace Tests\Units\Commands;

use MohsenAbrishami\Stethoscope\LogRecord\Facades\Record;
use Tests\TestCase;

class MonitorCommandTest extends TestCase
{
    public function test_run_monitor_command()
    {
        Record::shouldReceive('record')->once();

        $this->artisan('stethoscope:monitor')->assertOk();
    }
}
