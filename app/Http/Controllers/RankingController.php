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
use App\Models\UserStatistics;
use Request;

class RankingController extends Controller
{
    protected $section = 'rankings';

    const PAGE_SIZE = 20;
    const MAX_RESULTS = 10000;
    const RANKING_TYPES = ['performance', 'score'];

    public function index($mode, $type, $page = 1)
    {
        $maxPages = ceil(static::MAX_RESULTS / static::PAGE_SIZE);
        $page = clamp(get_int($page), 1, $maxPages);

        if (!array_key_exists($mode, Beatmap::MODES)) {
            abort(404);
        }

        if (!in_array($type, static::RANKING_TYPES)) {
            abort(404);
        }

        $stats = UserStatistics\Model::getClass($mode)
            ->with('user')
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            })
            ->limit(static::PAGE_SIZE)
            ->offset(static::PAGE_SIZE * ($page - 1));

        switch ($type) {
            case 'performance':
                $stats->orderBy('rank_score', 'desc');
                break;
            case 'score':
                $stats->orderBy('ranked_score', 'desc');
                break;
        }

        $scores = json_collection($stats->get(), 'UserStatistics', ['user']);

        $scores = [
            'mode' => $mode,
            'scores' => $scores,
            'paging' => [
                'page' => $page,
                'pages' => $maxPages,
            ],
        ];

        if (Request::ajax()) {
            return $scores;
        } else {
            return view('ranking.index', compact('scores'));
        }
    }
}
