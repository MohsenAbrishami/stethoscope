<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class StethoscopeCommand extends Command
{
    public function __construct(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer)
    {
        parent::__construct();

        $this->cpu = $cpu;
        $this->memory = $memory;
        $this->network = $network;
        $this->webServer = $webServer;

        $this->storage = Storage::disk(config('stethoscope.storage.driver'));
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stethoscope:listen';

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

        if ($this->storage->exists($file))
            $log = $this->storage->get($file);

        $log = $this->cpu->monitor($log);
        $log = $this->memory->monitor($log);
        $log = $this->network->monitor($log);
        $log = $this->webServer->monitor($log);

        if ($log != '')
            $this->storage->put($file, $log);
    }
}
