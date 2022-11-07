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
    const SKIP_VERIFICATION_ROUTES = [
        'account_controller@reissue_code' => true,
        'account_controller@verify' => true,
        'account_controller@verify_link' => true,
        'notifications_controller@endpoint' => true,
        'sessions_controller@destroy' => true,
        'sessions_controller@store' => true,
        'wiki_controller@image' => true,
        'wiki_controller@show' => true,
        'wiki_controller@sitemap' => true,
        'wiki_controller@suggestions' => true,
    ];

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

        return isset(static::SKIP_VERIFICATION_ROUTES[$currentRoute]);
    }
}
