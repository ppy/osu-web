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
use App\Transformers\BeatmapsetTransformer;
use Auth;
use Request;

class BeatmapsetsController extends Controller
{
    public function favourites()
    {
        $favourites = Auth::user()->favouriteBeatmapsets();

        return json_collection(
            $favourites->get(),
            new BeatmapsetTransformer()
        );
    }

    public function lookup()
    {
        $beatmapId = Request::input('beatmap_id');

        if (present($beatmapId)) {
            $beatmap = Beatmap::findOrFail($beatmapId);

            return app('App\Http\Controllers\BeatmapsetsController')->show($beatmap->beatmapset->beatmapset_id);
        }

        abort(404);
    }
}
