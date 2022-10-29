<?php

namespace Tests\Commands;

use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @covers \MohsenAbrishami\Stethosope\Commands\MonitorCommandTest
 */
class MonitorCommandTest extends TestCase
{
    use MessageCreatorTrait;

    public $log;

    public function setUp(): void
    {
        $this->log;

        parent::setUp();
    }

    public function test_assert_success_stethoscope_monitor_command()
    {
        $this->mockService(Cpu::class, 99);
        $this->mockService(HardDisk::class, 100);
        $this->mockService(Memory::class, 98);
        $this->mockService(Network::class, false);
        $this->mockService(WebServer::class, 'inactive');

        $this->artisan('stethoscope:monitor')
            ->assertOk();

        $file = config('stethoscope.storage.path') . now()->format('Y-m-d');

        $this->log = Storage::get($file);

        $this->checkTrue($this->cpuMessage(99));
        $this->checkTrue($this->hardDiskMessage(100));
        $this->checkTrue($this->memoryMessage(98));
        $this->checkTrue(!$this->networkMessage(false));
        $this->checkTrue($this->webServerMessage('inactive'));
    }

    private function checkTrue($message)
    {
        $this->assertTrue(Str::contains($this->log, $message));
    }
}
