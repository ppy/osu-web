<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\UserVerification;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Guard as AuthGuard;
use Illuminate\Http\Request;

class VerifyUser
{
    protected ?User $user;

    public function __construct(AuthGuard $auth)
    {
        $this->user = $auth->user();
    }

    public function handle(Request $request, Closure $next)
    {
        if (
            $this->user !== null
            && !$this->user->isSessionVerified()
            && !$this->alwaysSkipVerification()
            && $this->requiresVerification($request)
        ) {
            return UserVerification::fromCurrentRequest()->initiate();
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
