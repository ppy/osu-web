<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Http\Controllers\Multiplayer\Rooms\Playlist;

use App\Http\Controllers\Controller as BaseController;
use App\Libraries\Multiplayer\Mod;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\RoomScore;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class ScoresController extends BaseController
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($roomId, $playlistId)
    {
        $playlist = PlaylistItem::where('room_id', $roomId)->where('id', $playlistId)->firstOrFail();

        return json_collection(
            $playlist->topScores(),
            'Multiplayer\RoomScore',
            ['user.country']
        );
    }

    public function store($roomId, $playlistId)
    {
        $playlist = PlaylistItem::where('room_id', $roomId)->where('id', $playlistId)->firstOrFail();

        // todo: check against room's end time (to see if player has enough time to play this beatmap) and is under the room's max attempts limit

        $score = new RoomScore([
            'user_id' => Auth::user()->user_id,
            'room_id' => $playlist->room_id,
            'playlist_item_id' => $playlist->id,
            'beatmap_id' => $playlist->beatmap_id,
            'started_at' => Carbon::now(),
        ]);

        $score->saveOrExplode();

        return $score;
    }

    public function update($roomId, $playlistId, $scoreId)
    {
        // todo: check against room's end time, check within window of start_time + beatmap_length + x

        $playlist = PlaylistItem::where('room_id', $roomId)
            ->where('id', $playlistId)
            ->firstOrFail();

        $score = $playlist->scores()->where('id', $scoreId)->firstOrFail();

        if ($score->isCompleted()) {
            abort(403, "cannot modify score after submission");
        }

        foreach (['rank', 'total_score', 'accuracy', 'max_combo', 'passed'] as $field) {
            if (!Request::has($field) || !present(Request::input($field))) {
                abort(422, "field missing: '{$field}'");
            }
        }

        foreach (['mods', 'statistics'] as $field) {
            if (!Request::has($field) || !is_array(Request::input($field))) {
                abort(422, "field cannot be empty: '{$field}'");
            }
        }

        if (empty(Request::input('statistics'))) {
            abort(422, "field cannot be empty: 'statistics'");
        }

        $mods = Mod::parseInputArray(
            Request::input('mods'),
            $playlist->ruleset_id
        );

        Mod::validateSelection(array_column($mods, 'acronym'), $playlist->ruleset_id);

        // todo: also, all the validationsz:
        // - check required_mods are present
        // - check mods are within required_mods or allowed_mods
        // - validate statistics json format

        $score->rank = Request::input('rank');
        $score->total_score = get_int(Request::input('total_score'));
        $score->accuracy = get_float(Request::input('accuracy'));
        $score->max_combo = get_int(Request::input('max_combo'));
        $score->ended_at = Carbon::now();
        $score->passed = get_bool(Request::input('passed'));
        $score->mods = $mods;
        $score->statistics = Request::input('statistics');

        $score->saveOrExplode();

        return json_item(
            $score,
            'Multiplayer\RoomScore',
            ['user.country']
        );
    }
}
