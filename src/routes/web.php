<?php

use Illuminate\Support\Facades\Route;
use Riseuplabs\UrlHitCounter\Http\Controllers\RouteHitCounterController;

Route::get('route-hit-counter', [RouteHitCounterController::class, 'index']);