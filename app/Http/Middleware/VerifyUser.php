<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\UserVerification;
use Closure;
use Illuminate\Contracts\Auth\Guard as AuthGuard;
use Illuminate\Http\Request;

class VerifyUser
{
    protected $auth;

    public function __construct(AuthGuard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if (
            !$request->is([
                'home/account/reissue-code',
                'home/account/verify',
                'home/notifications/endpoint',
                'session',
            ]) && $this->requiresVerification($request)
        ) {
            $verification = UserVerification::fromCurrentRequest();

            if (!$verification->isDone()) {
                return $verification->initiate();
            }
        }

        return $next($request);
    }

    public function requiresVerification($request)
    {
        return true;
    }
}
