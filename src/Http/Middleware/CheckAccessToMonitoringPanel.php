<?php

namespace MohsenAbrishami\Stethoscope\Http\Middleware;

use Closure;

class CheckAccessToMonitoringPanel
{
    public function handle($request, Closure $next)
    {
        if (! config('stethoscope.monitoring_panel.status')) {
            abort(404);
        }

        if (config('stethoscope.monitoring_panel.key') && request()->get('key') != config('stethoscope.monitoring_panel.key')) {
            abort(404);
        }

        return $next($request);
    }
}
