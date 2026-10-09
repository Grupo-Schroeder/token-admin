<?php

namespace App\Http\Middleware;

use App\Models\ApiLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRequestLogger
{
    public function handle(Request $request, Closure $next): Response {
        $start = microtime(true);

        $response = $next($request);

        $duration = (int) round(
            (microtime(true) - $start) * 1000
        );

        $user = $request->user('api');

        $token = null;

        if ($user) {
            $token = $user->token();
        }

        ApiLog::create([
            'token_id' => $token?->id,
            'user_id' => $user?->id,

            'method' => $request->method(),

            'url' => $request->fullUrl(),

            'route' => $request->route()?->uri(),

            'status_code' => $response->getStatusCode(),

            'ip_address' => $request->ip(),

            'user_agent' => $request->userAgent(),

            'response_time_ms' => $duration,
        ]);

        return $response;
    }
}


