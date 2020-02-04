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
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AuthApi
{
    // TODO: this should be definable per-controller or action.
    public static function skipAuth($request)
    {
        static $skipGet = [
            'api/v2/changelog/',
            'api/v2/comments/',
            'api/v2/seasonal-backgrounds/',
        ];

        $path = "{$request->decodedPath()}/";

        return $request->isMethod('GET') && starts_with($path, $skipGet);
    }

    public function handle(Request $request, Closure $next)
    {
        auth()->shouldUse('api');
        optional(auth()->user())->markSessionVerified();

        if (static::skipAuth($request)) {
            return $next($request);
        }

        return app(Authenticate::class)->handle($request, $next, 'api');
    }
}
