<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AuthApi
{
    public function handle(Request $request, Closure $next)
    {
        auth()->shouldUse('api');

        optional(auth()->user())->markSessionVerified();

        return $next($request);
    }
}
