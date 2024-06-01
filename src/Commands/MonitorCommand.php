<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Illuminate\Console\Command;
use MohsenAbrishami\Stethoscope\Events\TroubleOccurred;
use MohsenAbrishami\Stethoscope\LogRecord\Facades\Record;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\storage;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class MonitorCommand extends Command
{
    public function __construct(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer, storage $storage)
    {
        parent::__construct();

        $this->cpu = $cpu;
        $this->memory = $memory;
        $this->network = $network;
        $this->webServer = $webServer;
        $this->storage = $storage;
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
        $logs = [];

        $cpuUsage = $this->cpu->check();
        $memoryUsage = $this->memory->check();
        $networkStatus = $this->network->check();
        $storageFreeSpace = $this->storage->check();
        $webServerStatuses = $this->webServer->check();

        if (config('stethoscope.monitorable_resources.cpu') && $cpuUsage > config(('stethoscope.thresholds.cpu'))) {
            $logs['cpu'] = $cpuUsage;
        }

        if ($memoryUsage > config(('stethoscope.thresholds.memory')) && config('stethoscope.monitorable_resources.memory')) {
            $logs['memory'] = $memoryUsage;
        }

        if ($networkStatus == 'disconnected' && config('stethoscope.monitorable_resources.network')) {
            $logs['network'] = $networkStatus;
        }

        if ($storageFreeSpace < config(('stethoscope.thresholds.storage')) && config('stethoscope.monitorable_resources.storage')) {
            $logs['storage'] = $storageFreeSpace;
        }

        if ($webServerStatuses != 'active' && config('stethoscope.monitorable_resources.web_server')) {
            $logs['webServer'] = $webServerStatuses;
        }

        Record::record($logs);

        if (! empty($logs)) {
            $logs['signature'] = $this->signature;
            TroubleOccurred::dispatch($logs);
        }
    }
}
