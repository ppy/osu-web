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

namespace App\Http\Controllers\API;

use App\Models\Beatmap;
use App\Transformers\API\BeatmapTransformer;
use App\Transformers\ScoreTransformer;
use Auth;
use Request;
use Response;

class BeatmapsController extends Controller
{
    public function scores()
    {
        // FIXME: scores are obtained via filename/checksum lookup for legacy reasons (temporarily)
        $checksum = Request::input('checksum');
        $filename = urldecode(Request::input('filename'));

        // look up by checksum
        if (present($checksum)) {
            $beatmap = Beatmap::where('checksum', $checksum)->first();
        }

        // if checksum is missing or not found, fall back to looking up by filename
        if ((!isset($beatmap) || !present($beatmap)) && present($filename)) {
            $beatmap = Beatmap::where('filename', $filename)->firstorFail();
        }

        if (!present($beatmap)) {
            abort(404);
        }

        $mode = presence(Request::input('mode'));
        $mods = presence(Request::input('mods'));
        $type = Request::input('type', 'global');

        $beatmapMeta = json_item($beatmap, new BeatmapTransformer());

        try {
            $scores = $beatmap->scoreboardJson($mode, $mods, $type, Auth::user());
        } catch (\InvalidArgumentException $exception) {
            return response(['error' => $exception->getMessage()], 400);
        }

        return ['beatmap' => $beatmapMeta] + $scores;
    }
}
