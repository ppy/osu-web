<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            return $response->header('Turbolinks-Location', $request->getRequestUri());
        }

        return $response;
    }
}
