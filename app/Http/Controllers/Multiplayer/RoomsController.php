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

namespace App\Http\Controllers\Multiplayer;

use App\Http\Controllers\Controller as BaseController;
use App\Libraries\Multiplayer\Mod;
use App\Models\Beatmap;
use App\Models\Chat\Channel;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use Carbon\Carbon;
use DB;

class RoomsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = Room::query();

        $mode = request('mode');
        if ($mode === 'ended') {
            $rooms->ended()->orderBy('ends_at', 'desc');
        } else {
            if ($mode === 'participated') {
                $rooms->hasParticipated(auth()->user());
            } else if ($mode === 'owned') {
                $rooms->startedBy(auth()->user());
            } else {
                $rooms->active();
            }

            $rooms->orderBy('id', 'desc');
        }

        return json_collection(
            $rooms
                ->with('host')
                ->with('playlist.beatmap.beatmapset')
                ->get(),
            'Multiplayer\Room',
            [
                'host',
                'playlist.beatmap.beatmapset'
            ]
        );
    }

    public function leaderboard($roomId)
    {
        return Room::findOrFail($roomId)->topScores();
    }

    public function show($room_id)
    {
        return json_item(
            Room::where('id', $room_id)
                ->with('host')
                ->with('playlist.beatmap.beatmapset')
                ->firstOrFail(),
            'Multiplayer\Room',
            [
                'host',
                'playlist.beatmap.beatmapset',
            ]
        );
    }

    public function join($roomId, $userId)
    {
        // this allows admins/whatever to add users to games in the future
        if (get_int($userId) !== auth()->user()->user_id) {
            abort(403);
        }

        $channel = Room::findOrFail($roomId)->channel;

        if (!$channel->hasUser(auth()->user())) {
            $channel->addUser(auth()->user());
        }

        return response([], 204);
    }

    public function part($roomId, $userId)
    {
        // this allows admins/host/whoever to remove users from games in the future
        if (get_int($userId) !== auth()->user()->user_id) {
            abort(403);
        }

        $channel = Room::findOrFail($roomId)->channel;

        if ($channel->hasUser(auth()->user())) {
            $channel->removeUser(auth()->user());
        }

        return response([], 204);
    }

    public function store()
    {
        $currentUser = auth()->user();
        $room = (new Room)->startGame($currentUser, request()->all());

        return json_item(
            $room,
            'Multiplayer\Room',
            'playlist'
        );
    }
}
