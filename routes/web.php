<?php

use Illuminate\Support\Facades\Route;
use MohsenAbrishami\Stethoscope\Http\Controllers\MonitoringPanelController;

Route::middleware(['check.access.to.monitoring.panel'])->group(function () {
    Route::get(
        config('stethoscope.monitoring_panel.path', 'monitoring-panel'),
        [MonitoringPanelController::class, 'index']
    )->name('monitoring-panel');
});
