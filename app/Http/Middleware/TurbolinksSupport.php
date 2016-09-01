<?php

namespace App\Http\Middleware;

use Closure;

class TurbolinksSupport
{
    /**
     * Add turbolinks-redirect header if previous request
     * was a redirect.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isTurbolinksRedirect = presence($request->header('Turbolinks-Referrer'));

        if ($isTurbolinksRedirect) {
            return $next($request)->header('Turbolinks-Location', $request->fullUrl());
        } else {
            return $next($request);
        }
    }
}
