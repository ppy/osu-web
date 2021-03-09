<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Jobs\Notifications\UserBeatmapsetNew;
use App\Jobs\Notifications\UserBeatmapsetRevive;
use App\Models\Beatmapset;

class BeatmapsetsController extends Controller
{
    public function broadcastNew($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        (new UserBeatmapsetNew($beatmapset))->dispatch();

        return response(null, 204);
    }

    public function broadcastRevive($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        (new UserBeatmapsetRevive($beatmapset))->dispatch();

        return response(null, 204);
    }
}
