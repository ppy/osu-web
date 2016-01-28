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

use App\Models\Beatmap;
use App\Models\BeatmapSet;
use App\Models\Genre;
use App\Models\Language;
use League\Fractal\Manager;
use App\Transformers\BeatmapSetTransformer;
use Request;
use Auth;

class BeatmapController extends Controller
{
    protected $section = 'beatmaps';

    public function index()
    {
        $fractal = new Manager();
        $languages = Language::listing();
        $genres = Genre::listing();
        $beatmaps = fractal_collection_array(
            BeatmapSet::listing(),
            new BeatmapSetTransformer,
            'difficulties'
        );

        // temporarily put filters here
        $modes = [['id' => null, 'name' => trans('beatmaps.mode.any')]];
        foreach (Beatmap::modes() as $name => $id) {
            $modes[] = ['id' => (string) $id, 'name' => trans("beatmaps.mode.{$name}")];
        }

        $statuses = [
            ['id' => null, 'name' => trans('beatmaps.status.any')],
            ['id' => '0', 'name' => trans('beatmaps.status.ranked-approved')],
            ['id' => '1', 'name' => trans('beatmaps.status.approved')],
            ['id' => '2', 'name' => trans('beatmaps.status.faves')],
            ['id' => '3', 'name' => trans('beatmaps.status.modreqs')],
            ['id' => '4', 'name' => trans('beatmaps.status.pending')],
            ['id' => '5', 'name' => trans('beatmaps.status.graveyard')],
            ['id' => '6', 'name' => trans('beatmaps.status.my-maps')],
        ];

        $extras = [
            ['id' => '0', 'name' => trans('beatmaps.extra.video')],
            ['id' => '1', 'name' => trans('beatmaps.extra.storyboard')],
        ];

        $ranks = [];
        foreach (['XH', 'X', 'SH', 'S', 'A', 'B', 'C', 'D'] as $rank) {
            $ranks[] = ['id' => $rank, 'name' => trans("beatmaps.rank.{$rank}")];
        }

        $filters = ['data' => compact('modes', 'statuses', 'genres', 'languages', 'extras', 'ranks')];

        return view('beatmaps.index', compact('filters', 'beatmaps'));
    }

    public function search()
    {
        $current_user = Auth::user();

        $params = [];

        if (is_null($current_user)) {
            $params = [
                'page' => Request::input('page'),
            ];
        } else {
            $params = [
                'query' => Request::input('q'),
                'mode' => Request::input('m'),
                'status' => Request::input('s'),
                'genre' => Request::input('g'),
                'language' => Request::input('l'),
                'extra' => array_filter(explode('-', Request::input('e')), 'strlen'),
                'rank' => array_filter(explode('-', Request::input('r')), 'strlen'),
                'page' => Request::input('page'),
                'sort' => explode('_', Request::input('sort')),
            ];

            if (!$current_user->isSupporter()) {
                unset($params['rank']);
            }
        }

        $params = array_filter(
            $params,
            function ($v, $k) {
                if (is_array($v)) {
                    return !empty($v);
                } else {
                    return presence($v) !== null;
                }
            },
            ARRAY_FILTER_USE_BOTH
        );

        $beatmaps = BeatmapSet::search($params);

        return fractal_collection_array(
            $beatmaps,
            new BeatmapSetTransformer,
            'difficulties'
        );
    }
}
