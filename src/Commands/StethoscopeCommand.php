<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class StethoscopeCommand extends Command
{
    public $storage;

    public function __construct()
    {
        parent::__construct();

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
        $file = now()->format('Y-m-d');

        $log = '';

        if ($this->storage->exists($file))
            $log = $this->storage->get($file);

        $log = $this->cpuMonitor($log);
        $log = $this->memoryMonitor($log);
        $log = $this->networkConnection($log);
        $log = $this->webServerMonitor($log);

        if ($log != '')
            $this->storage->put($file, $log);
    }
}
