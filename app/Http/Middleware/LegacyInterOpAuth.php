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

use Carbon\Carbon;
use Closure;

class LegacyInterOpAuth
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
        $timestamp = $request->query('timestamp');
        $diff = Carbon::createFromTimestamp($timestamp)->diffInSeconds();
        $signature = $request->header('X-LIO-Signature');
        $expected = hash_hmac('sha1', $request->fullUrl(), config('osu.legacy.shared_interop_secret'));

        if (!present($signature) || !present($timestamp) || $diff > 300 || !hash_equals($expected, $signature)) {
            abort(403);
        }

        return $next($request);
    }
}
