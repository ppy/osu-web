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

namespace App\Http\Controllers;

use App\Models\Contest;
use Carbon\Carbon;
use stdClass;

class SeasonalBackgroundsController extends Controller
{
    protected $section = 'community';
    protected $actionPrefix = 'seasonal_backgrounds-';

    public function index()
    {
        $contest = Contest::find(config('osu.seasonal.contest_id'));

        if ($contest === null) {
            return response()->json(new stdClass);
        }

        $backgrounds = $contest->userContestEntries()->where('show_in_client', true)->get();

        return [
            'ends_at' => json_time(Carbon::parse(config('osu.seasonal.ends_at'))),

            'backgrounds' => json_collection($backgrounds, 'SeasonalBackground'),
        ];
    }
}
