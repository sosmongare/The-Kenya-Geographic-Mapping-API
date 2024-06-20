<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Log details to database
        ApiLog::create([
            'method' => $request->getMethod(),
            'url' => $request->getUri(),
            'endpoint' => $request->getPathInfo(),
            'status' => $response->getStatusCode(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'response_time' => microtime(true) - LARAVEL_START,
        ]);

        return $response;
    }
}
