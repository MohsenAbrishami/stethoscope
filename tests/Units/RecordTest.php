<?php

namespace Tests\Units;

use Illuminate\Support\Facades\Notification;
use MohsenAbrishami\Stethoscope\LogRecord\Facades\Record;
use Tests\TestCase;

/**
 * @covers \MohsenAbrishami\Stethosope\Commands\MonitorCommandTest
 */
class RecordTest extends TestCase
{
    public function test_run_record_method_in_monitor_command()
    {
        Notification::fake();

        Record::shouldReceive('record')->once();

        $this->artisan('stethoscope:monitor')->assertOk();
    }
}
