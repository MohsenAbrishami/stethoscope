<?php

namespace MohsenAbrishami\Stethoscope\Http\Controllers;

use Illuminate\Support\Facades\DB;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class MonitorController extends Controller
{
    public function current(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer, HardDisk $hardDisk)
    {
        return response()->json([
            'cpu' => $cpu->check(),
            'memory' => $memory->check(),
            'network' => $network->check(),
            'web_server' => $webServer->check(),
            'hard_disk' => $hardDisk->check(),
        ]);
    }

    public function history($from, $to)
    {
        $resourceLogs = ResourceLog::select('date', DB::raw('count(date)'))->orderBy('date')
            ->from(
                ResourceLog::whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->select(DB::raw('date(created_at) as date')),
                'count'
            )->groupBy('date')->get();

        return response()->json($resourceLogs);
    }
}
