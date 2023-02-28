<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestCost
{
    public static function getCost(Request $request): int
    {
        return $request->attributes->get('request_cost', 1);
    }

    public static function setCost(int $cost, ?Request $request = null)
    {
        // max(1, ) is a convenience for callers that use count()
        ($request ?? request())->attributes->set('request_cost', max(1, $cost));
    }

    public function handle(Request $request, Closure $next, int $cost = 1)
    {
        static::setCost($cost, $request);

        return $next($request);
    }
}
