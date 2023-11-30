<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;

class StripCookies
{
    public function handle($request, Closure $next)
    {
        $result = $next($request);

        if ($request->attributes->get('strip_cookies')) {
            // strip all cookies from response
            $result->headers->remove('set-cookie');
        }

        return $result;
    }
}
