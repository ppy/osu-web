<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use Request;

class BeatmapsController extends Controller
{
    public function show($id)
    {
        $beatmap = Beatmap::findOrFail($id);

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes']);
    }

    public function lookup()
    {
        $checksum = Request::input('checksum');
        $filename = urldecode(Request::input('filename'));

        // Try to look up via checksum
        if (present($checksum)) {
            $beatmap = Beatmap::where('checksum', $checksum)->first();
        }

        // If checksum is missing (or not found), try to look up by filename instead
        if (!isset($beatmap) && present($filename)) {
            $beatmap = Beatmap::where('filename', $filename)->firstOrFail();
        }

        if (!isset($beatmap)) {
            abort(404);
        }

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes']);
    }
}
