<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\Beatmap;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\PlaylistItem;
use Carbon\Carbon;
use Request;
use Auth;
use DB;

class RoomsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = Room::active()
            ->orderBy('id', 'DESC');

        if (Request::has('owned')) {
            $rooms->forUser(Auth::user());
        }

        if (Request::has('participated')) {
            // TODO: this
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

    public function show($id)
    {
        return json_item(
            Room::findOrFail($id),
            'Multiplayer\Room',
            'playlist'
        );
    }

    public function store()
    {
        $currentUser = Auth::user();
        $hasActiveRooms = Room::active()->forUser($currentUser)->exists();
        if ($hasActiveRooms) {
            abort(403, 'number of simultaneously active rooms reached');
        }

        foreach (['name', 'max_attempts', 'playlist_items'] as $field) {
            if (!Request::has($field) || !present(Request::input($field))) {
                abort(422, "field '{$field}' required");
            }

            $$field = Request::input($field);
        }

        if (!is_array($playlist_items) || empty($playlist_items)) {
            abort(422, "field 'playlist_items' cannot be empty");
        } else {
            $playlistBeatmaps = array_map(function ($item) {
                return $item['beatmap_id'];
            }, $playlist_items);

            $beatmaps = Beatmap::whereIn('beatmap_id', $playlistBeatmaps)->get();

            $playlist = [];
            foreach ($playlist_items as $item) {
                if (!$beatmaps->where('beatmap_id', $item['beatmap_id'])->first()) {
                    abort(422, "beatmap not found: {$item['beatmap_id']}");
                }

                $playlist[] = [
                    'beatmapId' => $item['beatmap_id'],
                    'allowedMods' => isset($item['allowed_mods']) ? $item['allowed_mods'] : [],
                    'requiredMods' => isset($item['required_mods']) ? $item['required_mods'] : [],
                ];
            }
        }

        if (Request::has('starts_at')) {
            $startTime = Carbon::parse(Request::input('starts_at'));
        } else {
            $startTime = Carbon::now();
        }

        if (Request::has('ends_at')) {
            $endTime = Carbon::parse(Request::input('ends_at'));

            if ($endTime->isBefore($startTime)) {
                abort(422, "'ends_at' cannot be before 'starts_at'");
            }
        } elseif (Request::has('duration')) {
            $endTime = $startTime->copy()->addMinutes(Request::input('duration'));
        } else {
            abort(422, "field 'duration' or 'ends_at' required");
        }

        $roomOptions = [
            'name' => Request::input('name'),
            'user_id' => $currentUser->user_id,
            'starts_at' => $startTime,
            'ends_at' => $endTime,
            'max_attempts' => Request::input('max_attempts'),
        ];

        $room = DB::transaction(function () use ($roomOptions, $playlist) {
            $room = new Room($roomOptions);
            $room->save();

            foreach ($playlist as $item) {
                try {
                    $playlistItem = new PlaylistItem();
                    $playlistItem->beatmap_id = $item['beatmapId'];
                    $playlistItem->room()->associate($room);
                    $playlistItem->allowed_mods = $item['allowedMods'];
                    $playlistItem->required_mods = $item['requiredMods'];
                    $playlistItem->save();
                } catch (\Exception $e) {
                    abort(422, $e->getMessage());
                }
            }

            return $room;
        });

        return json_item(
            $room,
            'Multiplayer\Room',
            'playlist'
        );
    }
}
