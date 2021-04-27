<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Jobs\BeatmapsetDelete;
use App\Jobs\Notifications\UserBeatmapsetNew;
use App\Models\Beatmapset;
use App\Models\User;

class BeatmapsetsController extends Controller
{
    public function broadcastNew($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        (new UserBeatmapsetNew($beatmapset))->dispatch();

        return response(null, 204);
    }

    public function destroy($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);
        $user = User::findOrFail(config('osu.legacy.bancho_bot_user_id'));

        (new BeatmapsetDelete($beatmapset, $user))->handle();

        return response(null, 204);
    }
}
