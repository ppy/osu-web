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
        $params = get_params(request()->all(), null, ['checksum:string', 'filename:string', 'id:int']);

        // Try to look up via checksum
        if (present($params['checksum'] ?? null)) {
            $beatmap = Beatmap::where('checksum', $params['checksum'])->first();
        }

        // And then via id if checksum lookup doesn't yield anything
        if (!isset($beatmap) && isset($params['id'])) {
            $beatmap = Beatmap::find($params['id']);
        }

        // Lastly, try to look up by filename
        if (!isset($beatmap) && present($params['filename'] ?? null)) {
            $beatmap = Beatmap::where('filename', $params['filename'])->first();
        }

        if (!isset($beatmap)) {
            abort(404);
        }

        return json_item($beatmap, 'Beatmap', ['beatmapset.ratings', 'failtimes']);
    }
}
