<?php

namespace App\Providers;

use App\Http\Controllers\Passport\AuthorizationController;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
        Passport::ignoreMigrations();
    }

    public function boot()
    {
        Passport::tokensExpireIn(Carbon::now()->addDays(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addMonths(3));

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);

        if ($path = config('services.passport.path')) {
            Passport::keyPath($path);
        }

        Passport::routes(function ($router) {
            $router->forAuthorization();
        });

        // Override/selectively pick routes.
        // RouteServiceProvider current runs before our provider, so Passport's default routes will override
        // those set in routes/web.php.
        Route::group(['prefix' => 'oauth', 'as' => 'oauth.'], function () {
            Route::post('token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->middleware('throttle')->name('passport.token');
            Route::get('authorize', AuthorizationController::class.'@authorize')
                ->middleware(['web', 'verify-user'])
                ->name('authorizations.authorize');
        });

        Passport::tokensCan([
            'friends.read' => trans('api.scopes.friends.read'),
            'identify' => trans('api.scopes.identify'),
        ]);
    }
}
