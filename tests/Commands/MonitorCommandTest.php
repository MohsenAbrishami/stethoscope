<?php

namespace Tests\Commands;

use Tests\TestCase;

/**
 * @covers \MohsenAbrishami\Stethosope\Commands\MonitorCommandTest
 */
class MonitorCommandTest extends TestCase
{
    public function test_assert_success_stethoscope_monitor_command()
    {
        $this->artisan('stethoscope:monitor')
            ->assertSuccessful();
    }
}
