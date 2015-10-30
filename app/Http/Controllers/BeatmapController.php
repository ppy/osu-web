<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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
use League\Fractal\Resource\Collection;
use App\Transformers\BeatmapTransformer;
use Request;

class BeatmapController extends Controller
{
    protected $section = 'beatmaps';

    public function index()
    {
        $fractal = new Manager();

        $languages = Language::listing();
        $genres = Genre::listing();

        $data = new Collection(BeatmapSet::listing(), new BeatmapTransformer);
        $beatmaps = $fractal->createData($data)->toArray();

    // these can go here for now ┐(￣ー￣)┌

    $modes = [
      ['id' => null, 'name' => trans('beatmaps.mode.any')],
      ['id' => Beatmap::OSU, 'name' => trans('beatmaps.mode.osu')],
      ['id' => Beatmap::TAIKO, 'name' => trans('beatmaps.mode.taiko')],
      ['id' => Beatmap::CTB, 'name' => trans('beatmaps.mode.catch')],
      ['id' => Beatmap::MANIA, 'name' => trans('beatmaps.mode.mania')],
    ];

        $statuses = [
      ['id' => null, 'name' => trans('beatmaps.status.all')],
      ['id' => 0, 'name' => trans('beatmaps.status.ranked-approved')],
      ['id' => 1, 'name' => trans('beatmaps.status.approved')],
      ['id' => 2, 'name' => trans('beatmaps.status.faves')],
      ['id' => 3, 'name' => trans('beatmaps.status.modreqs')],
      ['id' => 4, 'name' => trans('beatmaps.status.pending')],
      ['id' => 5, 'name' => trans('beatmaps.status.graveyard')],
      ['id' => 6, 'name' => trans('beatmaps.status.my-maps')],
    ];

        $extras = [
      ['id' => 0, 'name' => trans('beatmaps.extra.video')],
      ['id' => 1, 'name' => trans('beatmaps.extra.storyboard')],
    ];

        $ranks = [
      ['id' => null, 'name' => trans('beatmaps.rank.any')],
      ['id' => 0, 'name' => trans('beatmaps.rank.silver-ss')],
      ['id' => 1, 'name' => trans('beatmaps.rank.ss')],
      ['id' => 2, 'name' => trans('beatmaps.rank.silver-s')],
      ['id' => 3, 'name' => trans('beatmaps.rank.s')],
      ['id' => 4, 'name' => trans('beatmaps.rank.a')],
      ['id' => 5, 'name' => trans('beatmaps.rank.b')],
      ['id' => 6, 'name' => trans('beatmaps.rank.c')],
      ['id' => 7, 'name' => trans('beatmaps.rank.d')],
    ];

        $filters = ['data' => compact('modes', 'statuses', 'genres', 'languages', 'extras', 'ranks')];

        return view('beatmaps.index', compact('filters', 'beatmaps'));
    }

    public function search()
    {
        $params = [
      'query' => Request::input('q'),
      'mode' => Request::input('m'),
      'status' => Request::input('s'),
      'genre' => Request::input('g'),
      'language' => Request::input('l'),
      'extra' => array_filter(explode('-', Request::input('e')), 'strlen'),
      'rank' => Request::input('r'),
      'page' => Request::input('page'),
    ];

        $params = array_filter($params, function ($v, $k) {
      if (is_array($v)) {
          return (!empty($v));
      } else {
          return (presence($v) !== null);
      }
    }, ARRAY_FILTER_USE_BOTH);

        $fractal = new Manager();
        $data = new Collection(BeatmapSet::search($params), new BeatmapTransformer);
        $beatmaps = $fractal->createData($data)->toArray();

        return $beatmaps;
    }
}
