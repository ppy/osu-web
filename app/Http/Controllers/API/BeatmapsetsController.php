<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\API;

use App\Models\Beatmap;
use Request;

class BeatmapsetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public');
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
