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

namespace App\Http\Controllers\Multiplayer;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Multiplayer\Room;

class RoomsController extends BaseController
{
    protected $section = 'multiplayer';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = Room::query();
        $limit = clamp(get_int(request('limit')) ?? 250, 1, 250);

        $mode = request('mode');
        if ($mode === 'ended') {
            $rooms->ended()->orderBy('ends_at', 'desc');
        } else {
            if ($mode === 'participated') {
                // TODO: should probably do some kind of caching on this.
                $rooms->hasParticipated(auth()->user());
            } elseif ($mode === 'owned') {
                $rooms->startedBy(auth()->user());
            } else {
                $rooms->active();
            }

            $rooms->orderBy('id', 'desc');
        }

        return json_collection(
            $rooms
                ->with('host.country')
                ->with('playlist.beatmap.beatmapset')
                ->paginate($limit),
            'Multiplayer\Room',
            [
                'host.country',
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

        Room::findOrFail($roomId)->join(auth()->user());

        return response([], 204);
    }

    public function leaderboard($roomId)
    {
        $limit = clamp(get_int(request('limit')) ?? 50, 1, 50);

        return json_collection(
            Room::findOrFail($roomId)
                ->topScores()
                ->paginate($limit),
            'Multiplayer\UserScoreAggregate',
            ['user.country']
        );
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

    public function show($roomId)
    {
        return json_item(
            Room::findOrFail($roomId)
                ->load('host.country')
                ->load('playlist.beatmap.beatmapset'),
            'Multiplayer\Room',
            [
                'host.country',
                'playlist.beatmap.beatmapset',
                'recent_participants',
            ]
        );
    }

    public function store()
    {
        try {
            $room = (new Room)->startGame(auth()->user(), request()->all());

            return json_item(
                $room
                    ->load('host.country')
                    ->load('playlist.beatmap.beatmapset'),
                'Multiplayer\Room',
                [
                    'host.country',
                    'playlist.beatmap.beatmapset',
                    'recent_participants',
                ]
            );
        } catch (InvariantException $e) {
            return error_popup($e->getMessage(), $e->getStatusCode());
        }
    }
}
