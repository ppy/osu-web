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
        $turbolinksLocation = session('_turbolinks-location');

        if (present($turbolinksLocation)) {
            $response = $next($request);

            return $response->header('Turbolinks-Location', $turbolinksLocation);
        } else {
            return $next($request);
        }
    }
}
