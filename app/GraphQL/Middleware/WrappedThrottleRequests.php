<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Middleware;

use App\GraphQL\Exceptions\ThrottledException;
use App\Http\Middleware\ThrottleRequests;
use Closure;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class WrappedThrottleRequests extends ThrottleRequests
{
    public static function getGraphQLThrottle()
    {
        return 'throttle-graphql:'.config('osu.api.throttle.graphql').':';
    }

    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = '')
    {
        try {
            return parent::handle($request, $next, $maxAttempts, $decayMinutes, $prefix);
        } catch (ThrottleRequestsException) {
            $error = new ThrottledException(parent::getTimeUntilNextRetry($prefix.parent::resolveRequestSignature($request)));
            return $error->throw();
        }
    }
}
