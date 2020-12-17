<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmapset;
use Auth;
use Exception;

class BeatmapsetWatchesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function update($beatmapsetId)
    {
        $beatmapset = Beatmapset::where('discussion_enabled', '=', true)->findOrFail($beatmapsetId);

        try {
            $beatmapset->watches()->create(['user_id' => Auth::user()->getKey()]);
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        return response([], 204);
    }

    public function destroy($beatmapsetId)
    {
        $beatmapset = Beatmapset::findOrFail($beatmapsetId);

        $beatmapset->watches()->where('user_id', '=', Auth::user()->getKey())->delete();

        return response([], 204);
    }
}
