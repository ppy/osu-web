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
        if (!$request->is([
            'home/account/reissue-code',
            'home/account/verify',
            'home/notifications/endpoint',
            'session',
        ]) && $this->requiresVerification($request)) {
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
