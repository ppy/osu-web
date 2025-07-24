<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Http\Controllers\Passport\AuthorizationController;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController;
use Laravel\Passport\Http\Controllers\DenyAuthorizationController;
use Laravel\Passport\Passport;
use Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function register()
    {
        Passport::enablePasswordGrant();
        Passport::ignoreRoutes();

        // Copied from PassportServiceProvider with the correct
        // AuthorizationController class.
        $this->app->when(AuthorizationController::class)
            ->needs(StatefulGuard::class)
            ->give(fn () => Auth::guard($GLOBALS['cfg']['passport']['guard']));
    }

    public function boot()
    {
        Passport::tokensExpireIn(Carbon::now()->addDays(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addMonths(3));

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);

        if ($path = $GLOBALS['cfg']['services']['passport']['path']) {
            Passport::keyPath($path);
        }

        // Override/selectively pick routes.
        // RouteServiceProvider current runs before our provider, so Passport's default routes will override
        // those set in routes/web.php.
        Route::group(['prefix' => 'oauth', 'as' => 'oauth.'], function () {
            Route::post('token', AccessTokenController::class.'@issueToken')->middleware('throttle')->name('passport.token');
            Route::get('authorize', AuthorizationController::class.'@authorize')
                ->middleware(['web', 'verify-user'])
                ->name('authorizations.authorize');

            Route::post('authorize', ApproveAuthorizationController::class.'@approve')
                ->middleware(['web', 'auth']);

            Route::delete('authorize', DenyAuthorizationController::class.'@deny')
                ->middleware(['web', 'auth']);
        });

        Passport::tokensCan([
            'delegate' => '',
            'forum.write' => osu_trans('api.scopes.forum.write'),
            'forum.write_manage' => osu_trans('api.scopes.forum.write_manage'),
            'chat.read' => osu_trans('api.scopes.chat.read'),
            'chat.write' => osu_trans('api.scopes.chat.write'),
            'chat.write_manage' => osu_trans('api.scopes.chat.write_manage'),
            'friends.read' => osu_trans('api.scopes.friends.read'),
            'identify' => osu_trans('api.scopes.identify'),
            'public' => osu_trans('api.scopes.public'),
        ]);
    }
}
