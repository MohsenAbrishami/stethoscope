<?php

namespace MohsenAbrishami\Stethoscope\Http\Controllers;

use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class StatusController extends Controller
{
    public function __construct(
        private Cpu $cpu,
        private Memory $memory,
        private Network $network,
        private WebServer $webServer,
        private HardDisk $hardDisk
    ) {
    }

    public function index()
    {
        return response()->json([
            'cpu' => $this->cpu->check(),
            'memory' => $this->memory->check(),
            'network' => $this->network->check(),
            'web_server' => $this->webServer->check(),
            'hard_disk' => $this->hardDisk->check(),
        ]);
    }
}
