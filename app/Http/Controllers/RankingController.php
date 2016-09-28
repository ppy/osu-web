<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
use App\Transformers\CountryTransformer;
use App\Transformers\CountryStatisticsTransformer;
use App\Transformers\UserStatisticsTransformer;
use League\Fractal\Manager;
use Auth;
use Request;

class RankingController extends Controller
{
    protected $section = 'ranking';

    protected $pageSize = 4;

    public function getOverall()
    {
        $countries = fractal_collection_array(Country::all(), new CountryTransformer);
        return view('ranking.overall', compact('countries'));
    }

    public function getCountry()
    {
        return view('ranking.country');
    }

    public function getCharts()
    {
        return view('ranking.charts');
    }

    public function getMapper()
    {
        return view('ranking.mapper');
    }

    public function scoresOverall()
    {
        $user = Auth::User();

        // TODO: Check if user is supporter when searching for friends.
        /*
        if ($type !== 'friends') {
            if (!$user) {
                abort(403);
            } elseif (!$user->isSupporter()) {
                return error_popup(trans('errors.supporter_only'));
            }
        }
        */

        $mode = studly_case(Request::input('mode', 'osu'));
        $country = Request::input('country', 'all');
        $page = Request::input('page', 0);
        $model = "\\App\\Models\\UserStatistics\\$mode";

        try {
            // TODO: Taking 5 scores ATM. Define variable of how many scores to take
            $stats = $model::orderBy('rank', 'asc')->offset($page * $this->pageSize)->limit($this->pageSize)->with('user');
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
        }

        if ($country !== 'all') {
            $stats = $stats->where('country_acronym', $country);
        }

        // TODO: Friends query
        /*
        $scores = $scores
            ->whereIn('user_id', model_pluck($user->friends(), 'zebra_id'));
        */

        return fractal_collection_array($stats->get(), new UserStatisticsTransformer, 'user');
    }

    public function scoresCountry()
    {
        try {
            // TODO: Taking 3 scores ATM. Define variable of how many scores to take
            $stats = Country::orderBy('pp', 'desc')->take(3);
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
        }

        return fractal_collection_array($stats->get(), new CountryStatisticsTransformer);
    }
}
