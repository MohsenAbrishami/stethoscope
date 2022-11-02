<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;

class MonitorCommand extends Command
{
    use MessageCreatorTrait;

    public function __construct(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer, HardDisk $hardDisk)
    {
        parent::__construct();

        $this->cpu = $cpu;
        $this->memory = $memory;
        $this->network = $network;
        $this->webServer = $webServer;
        $this->hardDisk = $hardDisk;

        $this->storage = Storage::disk(config('stethoscope.log_file_storage.driver'));
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
        $file = config('stethoscope.log_file_storage.path') . now()->format('Y-m-d');

        $cpuUsage = $this->cpu->check();
        $memoryUsage = $this->memory->check();
        $networkStatus = $this->network->check();
        $webServerStatus = $this->webServer->check();
        $hardDiskFreeSpace = $this->hardDisk->check();

        $log = '';

        if ($cpuUsage > config(('stethoscope.thresholds.cpu')) && config('stethoscope.monitorable_resources.cpu'))
            $log .= $this->cpuMessage($cpuUsage) . "\n";

        if ($memoryUsage > config(('stethoscope.thresholds.memory')) && config('stethoscope.monitorable_resources.memory'))
            $log .= $this->memoryMessage($memoryUsage) . "\n";

        if (!$networkStatus && config('stethoscope.monitorable_resources.network'))
            $log .= $this->networkMessage($networkStatus) . "\n";

        if ($webServerStatus == 'inactive' && config('stethoscope.monitorable_resources.web_server'))
            $log .= $this->webServerMessage($webServerStatus) . "\n";

        if ($hardDiskFreeSpace < config(('stethoscope.thresholds.hard_disk')) && config('stethoscope.monitorable_resources.hard_disk'))
            $log .= $this->hardDiskMessage($hardDiskFreeSpace) . "\n";

        if ($log != '') {
            $log = $this->timeMessage() . "\n" . $log;

            if ($this->storage->exists($file))
                $log = $this->storage->get($file) . "\n \n" . $log;

            $this->storage->put($file, $log);
        }
    }
}
