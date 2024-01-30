<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUserAlways extends VerifyUser
{
    const GET_ACTION_METHODS = [
        'GET' => true,
        'HEAD' => true,
        'OPTIONS' => true,
    ];

    public static function isRequired($user)
    {
        return $user !== null && ($user->isPrivileged() || $user->isInactive());
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->requiresVerification($request)) {
            return error_popup('disabled', 403);
        }

        return $next($request);
    }

    public function requiresVerification($request)
    {
        return !isset(static::GET_ACTION_METHODS[$request->getMethod()]);
    }
}
