<?php

namespace App\Http\Middleware;

use Closure;

class RestrictAccessByDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedDomain = 'autotag.pk';
        $referer = $request->header('referer');

        // Check if referer header is present and matches the allowed domain
        if ($referer && parse_url($referer, PHP_URL_HOST) === $allowedDomain) {
            return $next($request);
        }

        // Return a 403 Forbidden response if the domain is not allowed
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
