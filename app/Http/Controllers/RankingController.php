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

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\CountryStatistics;
use App\Models\Spotlight;
use App\Models\User;
use App\Models\UserStatistics;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class RankingController extends Controller
{
    protected $section = 'rankings';

    private $country;

    const PAGE_SIZE = 50;
    const MAX_RESULTS = 10000;
    const SPOTLIGHT_MAX_RESULTS = 40;
    const RANKING_TYPES = ['performance', 'charts', 'score', 'country'];
    const SPOTLIGHT_TYPES = ['charts'];

    public function __construct()
    {
        parent::__construct();

        $mode = request('mode');
        $type = request('type');

        view()->share('hasPager', !in_array($type, static::SPOTLIGHT_TYPES, true));
        view()->share('currentAction', $type);
        view()->share('mode', $mode);
        view()->share('type', $type);
        view()->share('spotlight', null); // so variable capture in selector function doesn't die.

        $this->middleware(function ($request, $next) use ($mode, $type) {
            if ($mode === null) {
                return ujs_redirect(route('rankings', ['mode' => 'osu', 'type' => 'performance']));
            }

            if (!Beatmap::isModeValid($mode)) {
                abort(404);
            }

            if ($type === null) {
                return ujs_redirect(route('rankings', ['mode' => $mode, 'type' => 'performance']));
            }

            if (!in_array($type, static::RANKING_TYPES, true)) {
                abort(404);
            }

            if (request()->has('country') && $type === 'performance') {
                $countryStats = CountryStatistics::where('display', 1)
                    ->where('country_code', request('country'))
                    ->first();

                if ($countryStats === null) {
                    return redirect(route('rankings', ['mode' => $mode, 'type' => $type]));
                }

                $this->country = $countryStats->country;
            }

            view()->share('country', $this->country);

            return $next($request);
        });
    }

    public function index($mode, $type)
    {
        if ($type === 'charts') {
            return $this->spotlight($mode);
        }

        $modeInt = Beatmap::modeInt($mode);

        if ($type === 'country') {
            $maxResults = CountryStatistics::where('display', 1)
                ->where('mode', $modeInt)
                ->count();

            $stats = CountryStatistics::where('display', 1)
                ->with('country')
                ->where('mode', $modeInt)
                ->orderBy('performance', 'desc');
        } else {
            $maxResults = min(
                $this->country !== null ? $this->country->usercount : static::MAX_RESULTS,
                static::MAX_RESULTS
            );

            $class = UserStatistics\Model::getClass($mode);
            $table = (new $class)->getTable();
            $stats = $class
                ::on('mysql-readonly')
                ->with(['user', 'user.country'])
                ->whereHas('user', function ($userQuery) {
                    $userQuery->default();
                });

            if ($this->country !== null) {
                $stats->where('country_acronym', $this->country['acronym']);
            }

            if ($type === 'performance') {
                $stats
                    ->orderBy('rank_score', 'desc')
                    ->from(DB::raw("{$table} FORCE INDEX (rank_score)"));
            } else { // 'score'
                $stats
                    ->orderBy('ranked_score', 'desc')
                    ->from(DB::raw("{$table} FORCE INDEX (ranked_score)"));
            }
        }

        $maxPages = ceil($maxResults / static::PAGE_SIZE);
        $page = clamp(get_int(request('page')), 1, $maxPages);

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

                default:
                    return json_collection($stats, 'UserStatistics', ['user', 'user.cover', 'user.country']);
            }
        }

        $scores = new LengthAwarePaginator($stats, $maxPages * static::PAGE_SIZE, static::PAGE_SIZE, $page, [
            'path' => route('rankings', ['mode' => $mode, 'type' => $type]),
        ]);

        return view("rankings.{$type}", compact('scores'));
    }

    public function spotlight($mode)
    {
        $chartId = get_int(request('spotlight'));

        $spotlights = Spotlight::orderBy('chart_id', 'desc')->get();
        if ($chartId === null) {
            $spotlight = $spotlights->first();
        } else {
            $spotlight = Spotlight::findOrFail($chartId);
        }

        $selectOptions = [
            'selected' => $this->optionFromSpotlight($spotlight),
            'options' => $spotlights->map(function ($s) {
                return $this->optionFromSpotlight($s);
            }),
        ];

        if ($spotlight->hasMode($mode)) {
            $scores = $this->getUserStats($spotlight, $mode)->get();
            $scoreCount = $spotlight->userStats($mode)->count();
            $beatmapsets = $spotlight->beatmapsets($mode)->with('beatmaps')->get();
        } else {
            $scores = collect();
            $scoreCount = 0;
            $beatmapsets = collect();
        }

        return view(
            'rankings.charts',
            compact('scores', 'scoreCount', 'selectOptions', 'spotlight', 'beatmapsets')
        );
    }

    private function getUserStats($spotlight, $mode)
    {
        // These models will not have the correct table name set on them
        // as they get overriden when Laravel hydrates them.
        return $spotlight->userStats($mode)
            ->with(['user', 'user.country'])
            ->whereHas('user', function ($userQuery) {
                $model = new User;
                $userQuery
                    ->from("{$model->getConnection()->getDatabaseName()}.{$model->getTable()}")
                    ->default();
            })
            ->orderBy('ranked_score', 'desc')
            ->limit(static::SPOTLIGHT_MAX_RESULTS);
    }

    private function optionFromSpotlight(Spotlight $spotlight) : array
    {
        return ['id' => $spotlight->chart_id, 'text' => $spotlight->name];
    }
}
