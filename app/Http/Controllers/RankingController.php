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
use Request;

class RankingController extends Controller
{
    protected $section = 'rankings';

    const PAGE_SIZE = 20;
    const MAX_RESULTS = 10000;
    const RANKING_TYPES = ['performance', 'score', 'country'];

    public function index($mode, $type)
    {
        if (!array_key_exists($mode, Beatmap::MODES) || !in_array($type, static::RANKING_TYPES, true)) {
            abort(404);
        }

        $country = null;
        $modeInt = Beatmap::modeInt($mode);

        if ($type === 'country') {
            $maxResults = CountryStatistics::where('display', 1)
                ->where('mode', $modeInt)
                ->count();

            $maxPages = ceil($maxResults / static::PAGE_SIZE);
            $page = clamp(get_int(Request::input('page')), 1, $maxPages);

            $stats = CountryStatistics::where('display', 1)
                ->with('country')
                ->where('mode', $modeInt)
                ->orderBy('performance', 'desc')
                ->limit(static::PAGE_SIZE)
                ->offset(static::PAGE_SIZE * ($page - 1));

            $scores = json_collection($stats->get(), 'CountryStatistics', ['country']);
        } else { // if $type == 'performance' || $type == 'score'
            if (Request::has('country')) {
                $country = Country::where('display', '>', 0)
                    ->where('acronym', Request::input('country'))
                    ->first();
            }

            $maxResults = min(isset($country) ? $country->usercount : static::MAX_RESULTS, static::MAX_RESULTS);
            $maxPages = ceil($maxResults / static::PAGE_SIZE);
            $page = clamp(get_int(Request::input('page')), 1, $maxPages);

            $stats = UserStatistics\Model::getClass($mode)
                ->with(['user', 'user.country'])
                ->whereHas('user', function ($userQuery) {
                    $userQuery->default();
                })
                ->limit(static::PAGE_SIZE)
                ->offset(static::PAGE_SIZE * ($page - 1));

            if ($country) {
                $stats->where('country_acronym', $country['acronym']);
            }

            switch ($type) {
                case 'performance':
                    $stats->orderBy('rank_score', 'desc');
                    break;
                case 'score':
                    $stats->orderBy('ranked_score', 'desc');
                    break;
            }
            $scores = json_collection($stats->get(), 'UserStatistics', ['user', 'user.country']);
        }

        $scores = new LengthAwarePaginator($scores, $maxPages * static::PAGE_SIZE, static::PAGE_SIZE, $page, [
            'path' => route('ranking', ['mode' => $mode, 'type' => $type]),
        ]);

        return view("ranking.{$type}", compact('scores', 'mode', 'type', 'country'));
    }
}
