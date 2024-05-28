<?php

namespace MohsenAbrishami\Stethoscope\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use MohsenAbrishami\Stethoscope\Services\Cpu;
use MohsenAbrishami\Stethoscope\Services\Storage;
use MohsenAbrishami\Stethoscope\Services\Memory;
use MohsenAbrishami\Stethoscope\Services\Network;
use MohsenAbrishami\Stethoscope\Services\WebServer;

class MonitorController extends Controller
{
    public function current(Cpu $cpu, Memory $memory, Network $network, WebServer $webServer, Storage $storage)
    {
        return response()->json([
            'cpu' => $cpu->check(),
            'memory' => $memory->check(),
            'network' => $network->check(),
            'web_server' => $webServer->check(),
            'storage' => $storage->check(),
        ]);
    }

    public function history($from, $to)
    {
        $logs = ResourceLog::where('created_at', '>=', $from.' 00:00:00')
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
                'cpu' => $this->resourceLogCount('cpu', $labels, $logs),
                'memory' => $this->resourceLogCount('memory', $labels, $logs),
                'storage' => $this->resourceLogCount('storage', $labels, $logs),
                'network' => $this->resourceLogCount('network', $labels, $logs),
                'web_server' => $this->resourceLogCount('webServer', $labels, $logs),
            ],
        ]);
    }

    protected function resourceLogCount($resource, $labels, $logs)
    {
        $logCount = [];
        foreach ($labels as $label) {
            $resourceCount = $logs->countBy(function ($logs) use ($resource, $label) {
                return $logs['resource'] == $resource && $logs['date'] == $label;
            });
            array_push($logCount, count($resourceCount) > 1 ? $resourceCount[1] : 0);
        }

        return $logCount;
    }
}
