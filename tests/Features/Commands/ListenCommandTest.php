<?php

namespace Tests\Features\Commands;

use Tests\TestCase;

/**
 * @covers \MohsenAbrishami\Stethosope\Commands\ListenCommandTest
 */
class ListenCommandTest extends TestCase
{
    public function test_monitor_all_resources_when_run_listen_command_without_arguments()
    {
        $this->artisan('stethoscope:listen')
            ->assertOk()
            ->expectsOutputToContain('cpu usage')
            ->expectsOutputToContain('memory usage')
            ->expectsOutputToContain('hard disk free space')
            ->expectsOutputToContain('network connection status')
            ->expectsOutputToContain('web server status');
    }

    public function test_monitor_all_resources_when_run_listen_command_with_all_arguments()
    {
        $this->artisan('stethoscope:listen cpu memory hdd network web-server')
            ->assertOk()
            ->expectsOutputToContain('cpu usage')
            ->expectsOutputToContain('memory usage')
            ->expectsOutputToContain('hard disk free space')
            ->expectsOutputToContain('network connection status')
            ->expectsOutputToContain('web server status');
    }

    public function test_only_monitor_cpu_memory_when_run_listen_command_with_cpu_memory_arguments()
    {
        $this->artisan('stethoscope:listen cpu memory')
            ->assertOk()
            ->expectsOutputToContain('cpu usage')
            ->expectsOutputToContain('memory usage')
            ->doesntExpectOutputToContain('hard disk free space')
            ->doesntExpectOutputToContain('network connection status')
            ->doesntExpectOutputToContain('web server status');
    }
}
