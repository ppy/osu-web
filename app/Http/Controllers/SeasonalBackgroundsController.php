<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Contest;
use Carbon\Carbon;
use stdClass;

class SeasonalBackgroundsController extends Controller
{
    public function index()
    {
        $contest = Contest::find(config('osu.seasonal.contest_id'));

        if ($contest === null) {
            return response()->json(new stdClass());
        }

        $backgrounds = $contest->userContestEntries()->where('show_in_client', true)->get();

        return [
            'ends_at' => json_time(Carbon::parse(config('osu.seasonal.ends_at'))),

            'backgrounds' => json_collection($backgrounds, 'SeasonalBackground'),
        ];
    }
}
