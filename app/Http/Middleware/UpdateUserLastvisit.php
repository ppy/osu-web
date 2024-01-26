<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\SessionVerification;
use App\Models\Country;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class UpdateUserLastvisit
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        if ($user !== null) {
            $token = $user->token();
            $shouldUpdate = $token === null || $token->client->password_client;

            if ($shouldUpdate) {
                $isInactive = $user->isInactive();
                if ($isInactive) {
                    $isVerified = SessionVerification\Helper::currentSession()->isVerified();
                }

                if (!$isInactive || $isVerified) {
                    $recordedLastVisit = $user->getRawAttribute('user_lastvisit');
                    $currentLastVisit = time();

                    if ($currentLastVisit - $recordedLastVisit > 300) {
                        $user->update([
                            'user_lastvisit' => $currentLastVisit,
                        ], ['skipValidations' => true]);
                    }
                }

                if ($token === null) {
                    $this->recordSession($request);
                }
            }
        }

        return $next($request);
    }

    private function recordSession($request)
    {
        // Add metadata to session to help user recognize this login location
        $countryCode = request_country($request);
        $country = $countryCode === null ? null : app('countries')->byCode($countryCode);
        $request->session()->put('meta', [
            'agent' => $request->header('User-Agent'),
            'country' => [
                'code' => $country?->acronym ?? Country::UNKNOWN,
                'name' => presence($country?->name) ?? 'Unknown',
            ],
            'ip' => $request->ip(),
            'last_visit' => Carbon::now(),
        ]);
    }
}
