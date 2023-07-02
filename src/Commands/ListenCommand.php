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

class ListenCommand extends Command
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
    protected $signature = 'stethoscope:listen {resources?*}';

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
        $resources = collect($this->argument('resources'));

        $resourcesIsEmpty = $resources->isEmpty();

        $this->line(
            $this->timeMessage()
        );

        if ($resources->contains('cpu') || $resourcesIsEmpty) {
            $this->info(
                $this->cpuMessage($this->cpu->check())
            );
        }

        if ($resources->contains('memory') || $resourcesIsEmpty) {
            $this->info(
                $this->memoryMessage($this->memory->check())
            );
        }

        if ($resources->contains('network') || $resourcesIsEmpty) {
            $this->info(
                $this->networkMessage($this->network->check())
            );
        }

        if ($resources->contains('web-server') || $resourcesIsEmpty) {
            $this->info(
                $this->webServerMessage($this->webServer->check())
            );
        }

        if ($resources->contains('hdd') || $resourcesIsEmpty) {
            $this->info(
                $this->hardDiskMessage($this->hardDisk->check())
            );
        }
    }
}
