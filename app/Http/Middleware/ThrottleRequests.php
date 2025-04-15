<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\RateLimiter;
use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests as ThrottleRequestsBase;

class ThrottleRequests extends ThrottleRequestsBase
{
    public function __construct(RateLimiter $limiter)
    {
        parent::__construct($limiter);
    }

    public static function getApiThrottle($group = 'global')
    {
        return 'throttle:'.$GLOBALS['cfg']['osu']['api']['throttle'][$group].':';
    }

    protected function handleRequest($request, Closure $next, array $limits)
    {
        foreach ($limits as $limit) {
            if ($this->limiter->tooManyAttempts($limit->key, $limit->maxAttempts)) {
                throw $this->buildException($request, $limit->key, $limit->maxAttempts, $limit->responseCallback);
            }
        }

        $response = $next($request);

        $cost = RequestCost::getCost($request);

        foreach ($limits as $limit) {
            // hit moved to after request is processed to be able to get the cost assigned by the controller action,
            // in constrast to the original function. This works fine since $next will handle exceptions
            // thrown by the controller so the rest of the function still runs.
            $this->limiter->hit($limit->key, $limit->decaySeconds, $cost);

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
