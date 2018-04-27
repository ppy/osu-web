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

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\Country;
use App\Models\CountryStatistics;
use App\Models\UserStatistics;
use Illuminate\Pagination\LengthAwarePaginator;
use Redirect;
use Request;

class RankingController extends Controller
{
    protected $section = 'rankings';

    const PAGE_SIZE = 50;
    const MAX_RESULTS = 10000;
    const RANKING_TYPES = ['performance', 'score', 'country'];

    public function index($mode = 'osu', $type = null)
    {
        if (!array_key_exists($mode, Beatmap::MODES)) {
            abort(404);
        }

        if ($type === null) {
            return ujs_redirect(route('rankings', ['mode' => $mode, 'type' => 'performance']));
        }

        if (!in_array($type, static::RANKING_TYPES, true)) {
            abort(404);
        }

        $country = null;
        $modeInt = Beatmap::modeInt($mode);

        if ($type === 'country') {
            $maxResults = CountryStatistics::where('display', 1)
                ->where('mode', $modeInt)
                ->count();

            $stats = CountryStatistics::where('display', 1)
                ->with('country')
                ->where('mode', $modeInt)
                ->orderBy('performance', 'desc');
        } else { // if $type == 'performance' || $type == 'score'
            if (Request::has('country')) {
                $countryStats = CountryStatistics::where('display', 1)
                    ->where('country_code', Request::input('country'))
                    ->first();

                if (!$countryStats) {
                    return Redirect::route('rankings', ['mode' => $mode, 'type' => $type]);
                } else {
                    $country = $countryStats->country;
                }
            }

            $maxResults = min(isset($country) ? $country->usercount : static::MAX_RESULTS, static::MAX_RESULTS);

            $stats = UserStatistics\Model::getClass($mode)
                ->on('mysql-readonly')
                ->with(['user', 'user.country'])
                ->whereHas('user', function ($userQuery) {
                    $userQuery->default();
                });

            if ($country) {
                $stats->where('country_acronym', $country['acronym']);
            }

            if ($type === 'performance') {
                $stats->orderBy('rank_score', 'desc');
            } else { // 'score'
                $stats->orderBy('ranked_score', 'desc');
            }
        }

        $maxPages = ceil($maxResults / static::PAGE_SIZE);
        $page = clamp(get_int(Request::input('page')), 1, $maxPages);

        if (is_api_request()) {
            $stats->with(['user.userProfileCustomization']);
        }

        $stats = $stats->limit(static::PAGE_SIZE)
            ->offset(static::PAGE_SIZE * ($page - 1))
            ->get();

        if (is_api_request()) {
            switch ($type) {
                case 'country':
                    return json_collection($stats, 'CountryStatistics', ['country']);
                break;

                case 'performance':
                case 'score':
                    return json_collection($stats, 'UserStatistics', ['user', 'user.cover', 'user.country']);
                    break;
            }
        } else {
            $scores = new LengthAwarePaginator($stats, $maxPages * static::PAGE_SIZE, static::PAGE_SIZE, $page, [
                'path' => route('rankings', ['mode' => $mode, 'type' => $type]),
            ]);

            return view("rankings.{$type}", compact('scores', 'mode', 'type', 'country'));
        }
    }
}
