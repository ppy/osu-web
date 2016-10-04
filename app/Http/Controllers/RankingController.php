<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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

use App\Models\Country;
use App\Models\User;
use App\Transformers\CountryTransformer;
use App\Transformers\CountryStatisticsTransformer;
use App\Transformers\UserStatisticsTransformer;
use League\Fractal\Manager;
use Auth;
use Request;

class RankingController extends Controller
{
    protected $section = 'ranking';

    // TODO: Adjust paginator page size
    protected $pageSize = 4;

    public function getOverall()
    {
        $currentUser = Auth::User();

        $currentMode = Request::input('mode', 'osu');
        $currentCountry = Request::input('country', 'all');
        $model = '\\App\\Models\\UserStatistics\\' . studly_case($currentMode);
        $friends = Request::input('friends', 0);

        if ($friends == 1) {
            if (!$currentUser) {
                abort(403);
            } elseif (!$currentUser->isSupporter()) {
                return error_popup(trans('errors.supporter_only'));
            }
        }

        try {
            $stats = $model::orderBy('rank', 'asc')->with('user');
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
        }

        if ($currentCountry !== 'all') {
            $stats = $stats->where('country_acronym', $currentCountry);
        }

        if ($friends == 1) {
            $stats = $stats->whereIn('user_id', model_pluck($currentUser->friends(), 'zebra_id'));
        }

        $stats = $stats->paginate($this->pageSize);
        $stats->appends(['country' => $currentCountry, 'mode' => $currentMode])->links();
        $countries = fractal_collection_array(Country::all(), new CountryTransformer);
        $topCountries = Country::where('display', '=', 1)->orderBy('pp', 'desc')->take(10)->get();
        return view('ranking.overall', compact('countries', 'stats', 'currentUser', 'currentMode', 'currentCountry', 'topCountries'));
    }

    public function getCountry()
    {
        $stats = Country::where('display', '=', 1)->orderBy('pp', 'desc')->paginate($this->pageSize);
        $currentUser = Auth::User();
        $userCountry = $currentUser ? Auth::User()->country_acronym : '';

        return view('ranking.country', compact('stats', 'userCountry'));
    }

    public function getCharts()
    {
        return view('ranking.charts');
    }

    public function getMapper()
    {
        $currentUser = Auth::User();
        $stats = User::where([['osu_kudostotal', '>=', 1]])->orderBy('osu_kudostotal', 'desc')->paginate($this->pageSize);

        return view('ranking.mapper', compact('stats', 'currentUser'));
    }
}
