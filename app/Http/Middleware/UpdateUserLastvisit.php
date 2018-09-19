<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Http\Middleware;

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
            $this->auth->user()->update([
                'user_lastvisit' => Carbon::createFromTime(null, null, 0),
            ], ['skipValidations' => true]);

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

        return $next($request);
    }
}
