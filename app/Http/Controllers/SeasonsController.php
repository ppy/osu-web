<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\SeasonTransformer;

class SeasonsController extends Controller
{
    public function rooms($id)
    {
        if ($id === 'latest') {
            $season = Season::last();

            if ($season === null) {
                abort(404);
            }
        } else {
            $season = Season::findOrFail($id);
        }

        $roomsJson = $this->getJson($season, request()->all());

        return $roomsJson;
    }

    public function show($id)
    {
        if ($id === 'latest') {
            $season = Season::last();

            if ($season === null) {
                abort(404);
            }
        } else {
            $season = Season::findOrFail($id);
        }

        $seasonJson = json_item($season, new SeasonTransformer());

        $seasons = Season::orderByDesc('id')->get();
        $seasonsJson = json_collection($seasons, new SeasonTransformer());

        $roomsJson = $this->getJson($season, request()->all());

        return ext_view('seasons.show', compact('roomsJson', 'seasonJson', 'seasonsJson'));
    }

    private function getJson($season, $rawParams)
    {
        $params = [
            'cursor' => cursor_from_params($rawParams),
            'limit' => get_int($params['limit'] ?? null),
        ];

        $limit = clamp($params['limit'] ?? 50, 1, 50);

        $search = Room::search([
            'cursor' => $params['cursor'],
            'limit' => $limit,
            'mode' => 'all',
            'season' => $season,
            'type_group' => 'playlists',
        ]);

        [$rooms, $hasMore] = $search['query']->with([
            'playlist.beatmap',
            'host',
        ])->getWithHasMore();

        $rooms->each->findAndSetCurrentPlaylistItem();
        $rooms->loadMissing('currentPlaylistItem.beatmap.beatmapset');

        $nextCursor = $hasMore ? $search['cursorHelper']->next($rooms) : null;

        return array_merge([
            'rooms' => json_collection($rooms, new RoomTransformer(), Room::INCLUDES_FOR_DISPLAY),
            'type_group' => 'playlists',
        ], cursor_for_response($nextCursor));
    }
}
