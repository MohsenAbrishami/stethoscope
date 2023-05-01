<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['check.access.to.monitoring.panel'])->group(function () {
    Route::get('/monitoring-panel', function () {
        return view('mohsenabrishami::MonitoringPanel');
    })->name('monitoring-panel');
});
