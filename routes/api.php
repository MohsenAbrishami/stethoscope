<?php

use Illuminate\Routing\Route;
use MohsenAbrishami\Stethoscope\Http\Controllers\StatusController;

Route::get('/get', [StatusController::class, 'index']);