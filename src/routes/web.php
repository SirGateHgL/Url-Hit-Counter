<?php

use Illuminate\Support\Facades\Route;
use Riseuplabs\RouteHitCounter\Http\Controllers\RouteHitCounterController;

Route::get('route-hit-counter', [RouteHitCounterController::class, 'index']);