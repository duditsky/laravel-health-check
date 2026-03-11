<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiLog;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CheckXOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $ownerUuid = $request->header('X-Owner');

        if (!$ownerUuid || !Str::isUuid($ownerUuid)) {
            return response()->json([
                'error' => 'Bad Request',
                'message' => 'Valid X-Owner (UUID) header is required.'
            ], 400);
        }

        ApiLog::create([
            'method'  => $request->method(),
            'url'     => $request->fullUrl(),
            'x_owner' => $ownerUuid,
            'ip'      => $request->ip(),
        ]);

        return $next($request);
    }
}
