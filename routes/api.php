<?php

use Illuminate\Support\Facades\Route;
use MohsenAbrishami\Stethoscope\Http\Controllers\StatusController;

Route::get('/statuses', [StatusController::class, 'index']);