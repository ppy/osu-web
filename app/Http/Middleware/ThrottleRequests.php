<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Ds\Map;
use Illuminate\Routing\Middleware\ThrottleRequests as ThrottleRequestsBase;

class ThrottleRequests extends ThrottleRequestsBase
{
    public static function getApiThrottle($group = 'global')
    {
        return 'throttle:'.config("osu.api.throttle.{$group}").':';
    }

    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = '')
    {
        /** @var ?Map $existingLimits */
        $existingLimits = $request->attributes->get('_limits');
        if ($existingLimits === null) {
            $existingLimits = new Map();
            $request->attributes->set('_limits', $existingLimits);
        }

        $existingLimits->put($prefix, [
            'decayMinutes' => $decayMinutes,
            'key' => $prefix.$this->resolveRequestSignature($request),
        ]);

        return parent::handle($request, $next, $maxAttempts, $decayMinutes, $prefix);
    }

    public function increment(int $cost = 1, string $prefix = '')
    {
        $limits = request()->attributes->get('_limits')?->get($prefix);
        if ($limits === null) {
            return;
        }

        $this->limiter->hit($limits['key'], $limits['decayMinutes'] * 60, $cost);
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
