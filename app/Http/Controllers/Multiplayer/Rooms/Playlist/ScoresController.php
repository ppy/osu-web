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
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use InvalidArgumentException;

class ScoresController extends BaseController
{
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
        $room = Room::findOrFail($roomId);
        $playlistItem = $room->playlist()->where('id', $playlistId)->firstOrFail();
        $score = $room->startPlay(auth()->user(), $playlistItem);

        // todo: check against room's end time (to see if player has enough time to play this beatmap) and is under the room's max attempts limit

        return json_item(
            $score,
            'Multiplayer\RoomScore'
        );
    }

    public function update($roomId, $playlistId, $scoreId)
    {
        $room = Room::findOrFail($roomId);
        // todo: check against room's end time, check within window of start_time + beatmap_length + x

        $playlistItem = $room->playlist()
            ->where('id', $playlistId)
            ->firstOrFail();

        $roomScore = $playlistItem->scores()
            ->where('user_id', auth()->user()->getKey())
            ->where('id', $scoreId)
            ->firstOrFail();

        try {
            $score = $room->completePlay(
                $roomScore,
                request()->all()
            );

            return json_item(
                $score,
                'Multiplayer\RoomScore',
                ['user.country']
            );
        } catch (InvalidArgumentException $e) {
            return error_popup($e->getMessage(), 422);
        }
    }
}
