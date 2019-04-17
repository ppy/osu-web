<?php

namespace App\Providers;

use App\Http\Controllers\Passport\AuthorizationController;
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

        if ($path = config('services.passport.path')) {
            Passport::keyPath($path);
        }

        Passport::routes();

        // RouteServiceProvider current runs before our provider, so Passport's default routes will override
        // those set in routes/web.php.
        Route::get('oauth/authorize', AuthorizationController::class.'@authorize')->middleware(['web']);

        Passport::tokensCan([
            'friends.read' => trans('api.scopes.friends.read'),
            'identify' => trans('api.scopes.identify'),
        ]);
    }
}
