<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Middleware;

use Closure;

class DisableSessionCookiesForAPI
{
    protected $apiRoutes = [
        'api/*',
    ];

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
        foreach ($this->apiRoutes as $route) {
            if ($request->is($route)) {
                // set session driver to array so session isn't persisted
                config()->set('session.driver', 'array');
                $stripCookies = true;
                break;
            }
        }

        $result = $next($request);

        if ($stripCookies ?? false) {
            // strip all cookies from response
            foreach ($result->headers->getCookies() as $cookie) {
                $result->headers->removeCookie($cookie->getName());
            }
        }

        return $result;
    }
}
