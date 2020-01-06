<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        Middleware\StripCookies::class,
        Middleware\DisableSessionCookiesForAPI::class,
        Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        Middleware\VerifyCsrfToken::class,
        Middleware\SetLocale::class,
        Middleware\AutologinFromLegacyCookie::class,
        Middleware\UpdateUserLastvisit::class,
        Middleware\VerifyUserAlways::class,
        Middleware\CheckUserBanStatus::class,
        Middleware\TurbolinksSupport::class,
        Middleware\DatadogMetrics::class,
    ];

    protected $middlewareGroups = [
        'api' => [],
        'web' => [],
        'lio' => [
            Middleware\LegacyInterOpAuth::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth-custom-api' => Middleware\AuthApi::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'check-user-restricted' => Middleware\CheckUserRestricted::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'require-scopes' => Middleware\RequireScopes::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verify-user' => Middleware\VerifyUser::class,
    ];
}
