<?php

use Illuminate\Support\Facades\Route;
use MohsenAbrishami\Stethoscope\Http\Controllers\MonitorController;

Route::get('monitor/current', [MonitorController::class, 'current']);
Route::get('monitor/history', [MonitorController::class, 'history']);