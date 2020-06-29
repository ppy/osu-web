<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;

class DisableSessionCookiesForAPI
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        config()->set('session.driver', 'array');

        $result = $next($request);

        foreach ($result->headers->getCookies() as $cookie) {
            $result->headers->removeCookie($cookie->getName());
        }

        return $result;
    }
}
