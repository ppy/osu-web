<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests as ThrottleRequestsBase;

class ThrottleRequests extends ThrottleRequestsBase
{
    public static function getApiThrottle($group = 'global')
    {
        return 'throttle:'.config("osu.api.throttle.{$group}").':';
    }

    protected function resolveRequestSignature($request)
    {
        $token = oauth_token();
        if ($token !== null) {
            return sha1($token->getKey());
        }

        return parent::resolveRequestSignature($request);
    }
}
