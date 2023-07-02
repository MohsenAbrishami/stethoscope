<?php

use Illuminate\Support\Facades\Route;
use MohsenAbrishami\Stethoscope\Http\Controllers\MonitorController;

Route::middleware(['check.access.to.monitoring.panel'])->group(function () {
    Route::get('monitor/current', [MonitorController::class, 'current']);
    Route::get('monitor/history/{from}/{to}', [MonitorController::class, 'history']);
});
