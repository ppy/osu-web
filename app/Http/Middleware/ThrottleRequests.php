<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests as ThrottleRequestsBase;

class ThrottleRequests extends ThrottleRequestsBase
{
    public static function getApiThrottle($group = 'global')
    {
        return 'throttle:'.config("osu.api.throttle.{$group}").':';
    }

    protected function handleRequest($request, Closure $next, array $limits)
    {
        foreach ($limits as $limit) {
            if ($this->limiter->tooManyAttempts($limit->key, $limit->maxAttempts)) {
                throw $this->buildException($request, $limit->key, $limit->maxAttempts, $limit->responseCallback);
            }
        }

        $response = $next($request);

        // Should still run even if the controller action throws.
        $cost = RequestCost::getCost($request);

        foreach ($limits as $limit) {
            $this->limiter->hit($limit->key, $limit->decayMinutes * 60, $cost);

            $response = $this->addHeaders(
                $response,
                $limit->maxAttempts,
                $this->calculateRemainingAttempts($limit->key, $limit->maxAttempts)
            );
        }

        return $response;
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
