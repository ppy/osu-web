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
use App\Models\BeatmapPack;
use App\Models\Beatmapset;
use App\Models\Score\Best;
use Auth;
use DB;

class BeatmapPacksController extends Controller
{
    protected $section = 'beatmaps';

    public function index($type = '')
    {
        $type = presence($type) ?? BeatmapPack::DEFAULT_TYPE;
        $packs = BeatmapPack::getPacks($type);
        if ($packs === null) {
            abort(404);
        }

        return view('beatmappacks.index')
            ->with('packs', $packs->get())
            ->with('type', $type);
    }

    public function show($id)
    {
        $pack = BeatmapPack::findOrFail($id);

        $beatmapsetTable = (new Beatmapset)->getTable();
        $beatmapsTable = (new Beatmap)->getTable();
        $scoreBestTable = (new Best\Osu)->getTable();
        $user_id = Auth::user()->user_id;

        $counts = DB::raw("(SELECT count(*)
                            FROM {$scoreBestTable}
                            WHERE {$scoreBestTable}.user_id = {$user_id}
                            AND {$scoreBestTable}.beatmap_id IN (
                                SELECT {$beatmapsTable}.beatmap_id
                                FROM {$beatmapsTable}
                                WHERE {$beatmapsTable}.beatmapset_id = {$beatmapsetTable}.beatmapset_id
                            )) as count");

        $sets = $pack
            ->beatmapsets()
            ->select("{$beatmapsetTable}.*", $counts)
            ->get();

        return view('beatmappacks.show', compact('pack', 'sets'));
    }
}
