<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Illuminate\Console\Command;
use MohsenAbrishami\Stethoscope\Events\TroubleOccurred;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\storage;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class HealthCommand extends Command
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
    protected $signature = 'stethoscope:health';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check server is up';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $resourceReports = [];

        $resourceReports['cpu'] = $this->cpu->check();
        $resourceReports['memory'] = $this->memory->check();
        $resourceReports['network'] = $this->network->check();
        $resourceReports['storage'] = $this->storage->check();
        $resourceReports['webServer'] = $this->webServer->check();

        TroubleOccurred::dispatch($resourceReports);
    }
}
