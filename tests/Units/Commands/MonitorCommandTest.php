<?php

namespace Tests\Units\Commands;

use Illuminate\Support\Facades\Mail;
use MohsenAbrishami\Stethoscope\LogRecord\Facades\Record;
use Tests\TestCase;

class MonitorCommandTest extends TestCase
{
    public function test_run_monitor_command()
    {
        Mail::fake();
        
        Record::shouldReceive('record')->once();

        $this->artisan('stethoscope:monitor')->assertOk();
    }
}
