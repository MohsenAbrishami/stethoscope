<?php

namespace MohsenAbrishami\Stethoscope\Http\Controllers;

class MonitoringPanelController extends Controller
{
    public function index()
    {
        return view('mohsenabrishami::MonitoringPanel', [
            'stethoscopeScriptVariables' => [
                'host' => url('/'),
                'monitoring_panel_key' => config('stethoscope.monitoring_panel.key'),
            ],
        ]);
    }
}
