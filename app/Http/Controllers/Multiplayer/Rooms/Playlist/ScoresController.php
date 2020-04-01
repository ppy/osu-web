<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Multiplayer\Rooms\Playlist;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller as BaseController;
use App\Libraries\Multiplayer\Mod;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use Carbon\Carbon;

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
                $this->extractRoomScoreParams(request()->all(), $playlistItem)
            );

            return json_item(
                $score,
                'Multiplayer\RoomScore',
                ['user.country']
            );
        } catch (InvariantException $e) {
            return error_popup($e->getMessage(), $e->getStatusCode());
        }
    }

    private function extractRoomScoreParams(array $params, PlaylistItem $playlistItem)
    {
        $mods = Mod::parseInputArray(
            $params['mods'] ?? [],
            $playlistItem->ruleset_id
        );

        return [
            'rank' => $params['rank'] ?? null,
            'total_score' => get_int($params['total_score'] ?? null),
            'accuracy' => get_float($params['accuracy'] ?? null),
            'max_combo' => get_int($params['max_combo'] ?? null),
            'ended_at' => Carbon::now(),
            'passed' => get_bool($params['passed'] ?? null),
            'mods' => $mods,
            'statistics' => $params['statistics'] ?? null,
        ];
    }
}
