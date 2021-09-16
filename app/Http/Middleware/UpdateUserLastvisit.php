<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\UserVerification;
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
        if ($this->auth->check()) {
            $user = auth()->user();

            $isInactive = $user->isInactive();

            if ($isInactive) {
                $isVerified = UserVerification::fromCurrentRequest()->isDone();
            }

            if (!$isInactive || $isVerified) {
                $recordedLastVisit = $user->user_lastvisit;
                $currentLastVisit = now();

                if ($currentLastVisit->diffInRealSeconds($recordedLastVisit) > 60) {
                    $user->update([
                        'user_lastvisit' => $currentLastVisit,
                    ], ['skipValidations' => true]);
                }
            }

            $this->recordSession($request);
        }

        return $next($request);
    }

    private function recordSession($request)
    {
        // Add metadata to session to help user recognize this login location
        $countryCode = presence(request_country($request)) ?? 'XX';
        $request->session()->put('meta', [
            'agent' => $request->header('User-Agent'),
            'country' => [
                'code' => $countryCode,
                'name' => presence(Country::where('acronym', $countryCode)->pluck('name')->first()) ?? 'Unknown',
            ],
            'ip' => $request->ip(),
            'last_visit' => Carbon::now(),
        ]);
    }
}
