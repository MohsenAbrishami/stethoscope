<?php

use Illuminate\Support\Facades\Route;

Route::get('/monitoring-panel', function () {
    return view('mohsenabrishami::MonitoringPanel');
})->name('monitoring-panel');
