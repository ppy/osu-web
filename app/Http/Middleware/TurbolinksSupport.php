<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $turbolinksLocation = $request->session()->pull('_turbolinks_location');

        $response = $next($request);

        // symphony responder (debug error page) doesn't have header method
        $isNormalResponse = method_exists($response, 'header');

        if ($isNormalResponse && present($turbolinksLocation)) {
            return $response->header('Turbolinks-Location', $turbolinksLocation);
        } else {
            return $response;
        }
    }
}
