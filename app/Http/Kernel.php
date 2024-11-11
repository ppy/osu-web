<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        Middleware\DatadogMetrics::class,
    ];

    protected $middlewareGroups = [
        'api' => [
            Middleware\AuthApi::class,
            Middleware\SetLocaleApi::class,
            Middleware\CheckUserBanStatus::class,
            Middleware\UpdateUserInfo::class,
            Middleware\VerifyUserAlways::class,
        ],
        'web' => [
            Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Middleware\VerifyCsrfToken::class,
            Middleware\SetSessionVerification::class,
            Middleware\SetLocale::class,
            Middleware\UpdateUserInfo::class,
            Middleware\VerifyUserAlways::class,
            Middleware\CheckUserBanStatus::class,
        ],
        'lio' => [
            Middleware\LegacyInterOpAuth::class,
        ],
    ];

    // TODO: check if laravel builtin order makes sense
    protected $middlewarePriority = [];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'check-user-restricted' => Middleware\CheckUserRestricted::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'request-cost' => Middleware\RequestCost::class,
        'require-scopes' => Middleware\RequireScopes::class,
        'throttle' => Middleware\ThrottleRequests::class,
        'verify-user' => Middleware\VerifyUser::class,
    ];
}
