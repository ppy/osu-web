<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;
use RuntimeException;

class ApiThrottleRequests extends ThrottleRequests
{
    protected function resolveRequestSignature($request)
    {
        $token = oauth_token();
        if ($token === null) {
            throw new RuntimeException('missing oauth token');
        }

        return sha1($token->getKey());
    }
}
