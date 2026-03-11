<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

class HealthCheckController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $dbStatus = false;
        $cacheStatus = false;

        try {
            DB::connection()->getPdo();
            $dbStatus = true;
        } catch (\Exception $e) {
            $dbStatus = false;
        }

        try {
            Cache::driver('redis')->set('health_check', 'ok', 5);
            $cacheStatus = Cache::driver('redis')->has('health_check');
        } catch (\Exception $e) {
            $cacheStatus = false;
        }

        $status = ($dbStatus && $cacheStatus) ? 200 : 500;

        return response()->json([
            'db' => $dbStatus,
            'cache' => $cacheStatus,
        ], $status);
    }
}
