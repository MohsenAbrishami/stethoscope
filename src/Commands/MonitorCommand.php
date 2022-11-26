<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Illuminate\Console\Command;
use MohsenAbrishami\Stethoscope\LogRecord\Facades\Record;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class MonitorCommand extends Command
{
    public function __construct(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer, HardDisk $hardDisk)
    {
        parent::__construct();

        $this->cpu = $cpu;
        $this->memory = $memory;
        $this->network = $network;
        $this->webServer = $webServer;
        $this->hardDisk = $hardDisk;
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stethoscope:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'monitor memory usage, cpu usage, network connection and nginx status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cpuUsage = $this->cpu->check();
        $memoryUsage = $this->memory->check();
        $networkStatus = $this->network->check();
        $webServerStatuses = $this->webServer->check();
        $hardDiskFreeSpace = $this->hardDisk->check();

        Record::record($cpuUsage, $memoryUsage, $networkStatus, $webServerStatuses, $hardDiskFreeSpace);
    }
}
