<?php

namespace MohsenAbrishami\Stethoscope\Http\Controllers;

use Carbon\CarbonPeriod;
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
        $resourceLogs = ResourceLog::where('created_at', '>=', $from.' 00:00:00')
            ->where('created_at', '<=', $to.' 23:59:59')
            ->select(DB::raw('date(created_at) as date'), 'resource')
            ->get();

        $labels = [];
        foreach (CarbonPeriod::create($from, $to) as $date) {
            array_push($labels, $date->format('Y-m-d'));
        }

        return response()->json([
            'labels' => $labels,
            'resource_log_count' => [
                'cpu' => $this->resourceLogCount('cpu', $labels, $resourceLogs),
                'memory' => $this->resourceLogCount('memory', $labels, $resourceLogs),
                'hard_disk' => $this->resourceLogCount('hardDisk', $labels, $resourceLogs),
                'network' => $this->resourceLogCount('network', $labels, $resourceLogs),
                'web_server' => $this->resourceLogCount('webServer', $labels, $resourceLogs),
            ],
        ]);
    }

    protected function resourceLogCount($resource, $labels, $resourceLogs)
    {
        $logCount = [];
        foreach ($labels as $label) {
            $resourceCount = $resourceLogs->countBy(function ($resourceLogs) use ($resource, $label) {
                return $resourceLogs['resource'] == $resource && $resourceLogs['date'] == $label;
            });
            array_push($logCount, count($resourceCount) > 1 ? $resourceCount[1] : 0);
        }

        return $logCount;
    }
}
