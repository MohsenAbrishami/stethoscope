<?php

namespace MohsenAbrishami\Stethoscope\Http\Middleware;

use Closure;

class CheckAccessToMonitoringPanel
{
    public function handle($request, Closure $next)
    {
        if (!config('stethoscope.monitoring_panel_status'))
            abort(404);

        if (config('stethoscope.monitoring_panel_key') && request()->get('key') != config('stethoscope.monitoring_panel_key'))
            abort(404);

        return $next($request);
    }
}
