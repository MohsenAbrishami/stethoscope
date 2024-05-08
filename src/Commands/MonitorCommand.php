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
        $resourceReports = [];

        $cpuUsage = $this->cpu->check();
        $memoryUsage = $this->memory->check();
        $networkStatus = $this->network->check();
        $storageFreeSpace = $this->storage->check();
        $webServerStatuses = $this->webServer->check();

        if (config('stethoscope.monitorable_resources.cpu') && $cpuUsage > config(('stethoscope.thresholds.cpu'))) {
            $resourceReports['cpu'] = $cpuUsage;
        }

        if ($memoryUsage > config(('stethoscope.thresholds.memory')) && config('stethoscope.monitorable_resources.memory')) {
            $resourceReports['memory'] = $memoryUsage;
        }

        if ($networkStatus == 'disconnected' && config('stethoscope.monitorable_resources.network')) {
            $resourceReports['network'] = $networkStatus;
        }

        if ($storageFreeSpace < config(('stethoscope.thresholds.storage')) && config('stethoscope.monitorable_resources.storage')) {
            $resourceReports['storage'] = $storageFreeSpace;
        }

        if ($webServerStatuses != 'active' && config('stethoscope.monitorable_resources.web_server')) {
            $resourceReports['webServer'] = $webServerStatuses;
        }

        Record::record($resourceReports);

        if (! empty($resourceReports)) {
            TroubleOccurred::dispatch($resourceReports);
        }
    }
}
