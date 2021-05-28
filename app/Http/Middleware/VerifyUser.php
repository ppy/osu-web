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
        if (!$this->alwaysSkipVerification() && $this->requiresVerification($request)) {
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

    private function alwaysSkipVerification()
    {
        $currentRouteData = app('route-section')->getCurrent();
        $currentRoute = "{$currentRouteData['controller']}@{$currentRouteData['action']}";

        static $routes = [
            'account_controller@reissue_code',
            'account_controller@verify',
            'account_controller@verify_link',
            'notifications_controller@endpoint',
            'sessions_controller@destroy',
            'sessions_controller@store',
            'wiki_controller@image',
            'wiki_controller@show',
            'wiki_controller@sitemap',
            'wiki_controller@suggestions',
        ];

        return in_array($currentRoute, $routes, true);
    }
}
