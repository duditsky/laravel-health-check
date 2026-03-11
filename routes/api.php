<?php

use App\Http\Controllers\Api\V1\HealthCheckController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health-check', HealthCheckController::class)
        ->middleware(['check.owner', 'throttle:60,1']);
});