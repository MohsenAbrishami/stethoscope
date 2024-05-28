<?php

namespace MohsenAbrishami\Stethoscope\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\Events\TroubleOccurred;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\Storage as StorageService;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;

class ListenCommand extends Command
{
    use MessageCreatorTrait;

    public function __construct(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer, StorageService $storage)
    {
        parent::__construct();

        $this->cpu = $cpu;
        $this->memory = $memory;
        $this->network = $network;
        $this->webServer = $webServer;
        $this->storageService = $storage;

        $this->storage = Storage::disk(config('stethoscope.storage.driver'));
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stethoscope:listen {resources?*} {--notif}';

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

        $logs = [];
        $logs['signature'] = $this->signature;

        $this->line(
            $this->timeMessage()
        );

        if ($resources->contains('cpu') || $resourcesIsEmpty) {
            $logs['cpu'] = $this->cpu->check();
            $this->info(
                $this->cpuMessage($logs['cpu'])
            );
        }

        if ($resources->contains('memory') || $resourcesIsEmpty) {
            $logs['memory'] = $this->memory->check();
            $this->info(
                $this->memoryMessage($logs['memory'])
            );
        }

        if ($resources->contains('network') || $resourcesIsEmpty) {
            $logs['network'] = $this->network->check();
            $this->info(
                $this->networkMessage($logs['network'])
            );
        }

        if ($resources->contains('web-server') || $resourcesIsEmpty) {
            $logs['webServer'] = $this->webServer->check();
            $this->info(
                $this->webServerMessage($logs['webServer'])
            );
        }

        if ($resources->contains('storage') || $resourcesIsEmpty) {
            $logs['storage'] = $this->storageService->check();
            $this->info(
                $this->storageMessage($logs['storage'])
            );
        }
        
        if ($this->option('notif')){
            TroubleOccurred::dispatch($logs);
        }
    }
}
