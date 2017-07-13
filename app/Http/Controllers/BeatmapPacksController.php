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

use App\Models\BeatmapPack;
use Auth;
use Request;

class BeatmapPacksController extends Controller
{
    protected $section = 'beatmaps';

    public function index($flag = '')
    {
        $type = presence(strtoupper($flag)) ?? 'S';
        if (!in_array($type, ['S', 'T', 'A', 'R'], true)) {
            abort(404);
        }

        $packs = BeatmapPack::where('tag', 'like', "{$type}%");
        if (in_array($type, ['S', 'R'])) {
            $packs = $packs->orderBy('pack_id', 'desc');
        } else {
            $packs = $packs->orderBy('name', 'asc');
        }
        $packs = $packs->get();

        return view('beatmappacks.index')
            ->with('packs', $packs);
    }

    public function show($id)
    {
        $pack = BeatmapPack::findOrFail($id);
        $sets = $pack->beatmapsets()->get();

        return view('beatmappacks.show', compact('pack', 'sets'));
    }
}
