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
        $isTurbolinks = presence($request->header('Turbolinks-Referrer'));
        $response = $next($request);

        // symphony responder (debug error page) doesn't have header method
        $isNormalResponse = method_exists($response, 'header');

        if ($isTurbolinks && $isNormalResponse) {
            return $response->header('Turbolinks-Location', $request->fullUrl());
        }

        return $response;
    }
}
