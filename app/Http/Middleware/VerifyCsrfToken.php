<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        'oauth/authorize',
        'oauth/access_token',
    ];

    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $_e) {
            $request->session()->flush();
            Auth::logout();
            $request->attributes->set('skip_session', true);
            $request->attributes->set('csrf', false);

            return $next($request);
        }
    }
}
