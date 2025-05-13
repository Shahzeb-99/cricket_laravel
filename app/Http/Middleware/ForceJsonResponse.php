<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Debugging - Log something to confirm it's running first
        \Log::info('ForceJsonRequestHeader middleware running');

        // Set the Accept header to application/json for all API requests
        $request->headers->set('Accept', 'application/json');

        // Proceed to the next middleware or the route handler
        return $next($request);
    }
}
