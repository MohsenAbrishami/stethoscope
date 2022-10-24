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

        $this->storage = Storage::disk(config('stethoscope.storage.driver'));
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
        $file = config('stethoscope.storage.path') . now()->format('Y-m-d H-i-s');

        $log = '';

        $cpuUsage = $this->cpu->monitor($log);
        $memoryUsage = $this->memory->monitor($log);
        $networkStatus = $this->network->monitor($log);
        $webServerStatus = $this->webServer->monitor($log);
        $hardDiskusage = $this->hardDisk->monitor($log);

        if ($cpuUsage > config(('stethoscope.thereshold.cpu')) && config('stethoscope.monitoring_enable.cpu'))
            $log .= $this->cpuMessage($cpuUsage) . "\n";

        if ($memoryUsage < config(('stethoscope.thereshold.hard_disk')) && config('stethoscope.monitoring_enable.hard_disk'))
            $log .= $this->memoryMessage($memoryUsage) . "\n";

        if (!$networkStatus && config('stethoscope.monitoring_enable.network'))
            $log .= $this->networkMessage($networkStatus) . "\n";

        if ($webServerStatus == 'inactive' && config('stethoscope.monitoring_enable.web_server'))
            $log .= $this->webServerMessage($webServerStatus) . "\n";

        if ($hardDiskusage < config(('stethoscope.thereshold.hard_disk')) && config('stethoscope.monitoring_enable.hard_disk'))
            $log .= $this->hardDiskMessage($hardDiskusage) . "\n";

        if ($log != '')
            $this->storage->put($file, $log);
    }
}
