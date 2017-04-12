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
use App\Transformers\ScoreTransformer;
use Auth;
use Request;

class BeatmapsController extends Controller
{
    protected $section = 'beatmaps';

    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $set = $beatmap->beatmapset;

        return ujs_redirect(route('beatmapsets.show', ['beatmap' => $set->beatmapset_id]).'#'.$beatmap->mode.'/'.$id);
    }

    public function scores($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $mode = Request::input('mode');
        $mods = Request::input('enabledMods');
        $type = Request::input('type', 'global');
        $user = Auth::user();

        try {
            return $beatmap->scoreboardJson($mode, $mods, $type, $user);
        } catch (\InvalidArgumentException $ex) {
            return error_popup($ex->getMessage());
        }
    }
}
