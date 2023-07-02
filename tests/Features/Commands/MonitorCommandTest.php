<?php

namespace Tests\Features\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;
use Tests\TestCase;

/**
 * @covers \MohsenAbrishami\Stethosope\Commands\MonitorCommandTest
 */
class MonitorCommandTest extends TestCase
{
    use MessageCreatorTrait;

    public $log;

    public $filePath;

    public function setUp(): void
    {
        parent::setUp();

        $this->log;
        $this->filePath = config('stethoscope.log_file_storage.path').now()->format('Y-m-d');

        Storage::delete($this->filePath);

        Notification::fake();
    }

    public function test_should_be_record_log_when_resources_exceeded_threshold()
    {
        $this->mockServices([
            Cpu::class => 99, HardDisk::class => 100, Memory::class => 98,
            Network::class => 'false', WebServer::class => 'inactive',
        ]);

        $this->artisan('stethoscope:monitor')->assertOk();

        $this->readLogFile();

        $this->assertTrue($this->assertContent($this->cpuMessage(99)));
        $this->assertTrue($this->assertContent($this->hardDiskMessage(100)));
        $this->assertTrue($this->assertContent($this->memoryMessage(98)));
        $this->assertTrue($this->assertContent($this->networkMessage('false')));
        $this->assertTrue($this->assertContent($this->webServerMessage('inactive')));
    }

    public function test_should_be_inserted_log_in_database_to_database_driver()
    {
        $this->mockServices([
            Cpu::class => 99, HardDisk::class => 100, Memory::class => 98,
            Network::class => 'false', WebServer::class => 'inactive',
        ]);

        Config::set('stethoscope.drivers.log_record', 'database');

        $this->artisan('stethoscope:monitor')->assertOk();

        $this->assertDatabaseHas('resource_logs', ['log' => 99, 'log' => 'false']);
    }

    public function test_should_be_not_record_log_when_resources_not_exceeded_threshold()
    {
        $this->mockServices([
            Cpu::class => 80, HardDisk::class => 100000000, Memory::class => 70,
            Network::class => true, WebServer::class => 'active',
        ]);

        $this->artisan('stethoscope:monitor')->assertOk();

        $this->readLogFile();

        $this->assertFalse(
            $this->assertContent(
                ['cpu usage', 'hard disk free space', 'memory usage', 'network connection status', 'web server status']
            )
        );
    }

    public function test_should_be_not_record_log_when_monitoring_is_disabled()
    {
        $this->mockServices([
            Cpu::class => 99, HardDisk::class => 100, Memory::class => 98,
            Network::class => 'false', WebServer::class => 'inactive',
        ]);

        Config::set('stethoscope.monitorable_resources.cpu', false);
        Config::set('stethoscope.monitorable_resources.memory', false);
        Config::set('stethoscope.monitorable_resources.hard_disk', false);
        Config::set('stethoscope.monitorable_resources.network', false);
        Config::set('stethoscope.monitorable_resources.web_server', false);

        $this->artisan('stethoscope:monitor')->assertOk();

        $this->readLogFile();

        $this->assertFalse(
            $this->assertContent(
                ['cpu usage', 'hard disk free space', 'memory usage', 'network connection status', 'web server status']
            )
        );
    }

    private function readLogFile()
    {
        $this->log = Storage::get($this->filePath);
    }

    private function assertContent($message)
    {
        return Str::contains($this->log, $message);
    }
}
