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
use App\Models\Multiplayer\UserScoreAggregate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            'user_id' => auth()->user()->user_id,
            'room_id' => $playlist->room_id,
            'playlist_item_id' => $playlist->id,
            'beatmap_id' => $playlist->beatmap_id,
            'started_at' => Carbon::now(),
        ]);

        $score->saveOrExplode();

        return json_item(
            $score,
            'Multiplayer\RoomScore'
        );
    }

    public function update($roomId, $playlistId, $scoreId)
    {
        $room = Room::findOrFail($roomId);
        // todo: check against room's end time, check within window of start_time + beatmap_length + x

        $playlist = $room->playlist()
            ->where('id', $playlistId)
            ->firstOrFail();

        $params = request()->all();

        $score = $playlist->scores()->where('id', $scoreId)->firstOrFail();

        if ($score->isCompleted()) {
            abort(403, "cannot modify score after submission");
        }

        foreach (['rank', 'total_score', 'accuracy', 'max_combo', 'passed'] as $field) {
            if (present($params[$field] ?? '')) {
                abort(422, "field missing: '{$field}'");
            }
        }

        foreach (['mods', 'statistics'] as $field) {
            if (($params[$field] ?? null) === null || !is_array($params[$field])) {
                abort(422, "field cannot be empty: '{$field}'");
            }
        }

        if (empty($params['statistics'])) {
            abort(422, "field cannot be empty: 'statistics'");
        }

        $mods = Mod::parseInputArray(
            $params['mods'],
            $playlist->ruleset_id
        );

        Mod::validateSelection(array_column($mods, 'acronym'), $playlist->ruleset_id);

        // todo: also, all the validationsz:
        // - check required_mods are present
        // - check mods are within required_mods or allowed_mods
        // - validate statistics json format

        $score->getConnection()->transaction(function () use ($mods, $params, $room, $score) {
            $score->rank = $params['rank'];
            $score->total_score = get_int($params['total_score']);
            $score->accuracy = get_float($params['accuracy']);
            $score->max_combo = get_int($params['max_combo']);
            $score->ended_at = Carbon::now();
            $score->passed = get_bool($params['passed']);
            $score->mods = $mods;
            $score->statistics = $params['statistics'];

            $score->saveOrExplode();

            if ($score->isCompleted()) {
                $room->addScore($score);
            }
        });

        return json_item(
            $score,
            'Multiplayer\RoomScore',
            ['user.country']
        );
    }
}
