<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\User\DatadogLoginAttempt;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        'home/changelog/github',
        'oauth/authorize',
        'payments/centili/callback',
        'payments/paypal/ipn',
        'payments/shopify/callback',
        'payments/xsolla/callback',
        'users',
    ];

    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $e) {
            $currentRouteData = app('route-section')->getCurrent();
            $currentRoute = "{$currentRouteData['controller']}@{$currentRouteData['action']}";

            if ($currentRoute === 'sessions_controller@store') {
                DatadogLoginAttempt::log('invalid_csrf');
            }

            throw new $e('Reload page and try again');
        }
    }
}
