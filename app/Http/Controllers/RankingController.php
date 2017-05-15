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
use App\Models\UserStatistics;
use App\Transformers\CountryTransformer;
use App\Transformers\UserStatisticsTransformer;
use Request;

class RankingController extends Controller
{
    protected $section = 'rankings';

    const PAGE_SIZE = 20;
    const MAX_RESULTS = 10000;

    public function index($mode, $type, $page = 1)
    {
        $max_pages = ceil($this::MAX_RESULTS / $this::PAGE_SIZE);

        if (!array_key_exists($mode, Beatmap::MODES)) {
            abort(404);
        }

        $stats = UserStatistics\Model::getClass($mode)
            ->with('user')
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            })
            ->orderBy('rank_score', 'desc')
            ->limit($this::PAGE_SIZE);

        $page = clamp(get_int($page), 1, $max_pages) - 1;

        $stats->offset($this::PAGE_SIZE * $page);

        $scores = json_collection($stats->get(), new UserStatisticsTransformer, ['user']);

        $scores = [
            'mode' => $mode,
            'scores' => $scores,
            'paging' => [
                'page' => $page,
                'pages' => $max_pages,
            ],
        ];

        if (Request::ajax()) {
            return $scores;
        } else {
            $countries = json_collection(Country::all(), new CountryTransformer);

            return view('ranking.index', compact('scores', 'countries'));
        }
    }
}
