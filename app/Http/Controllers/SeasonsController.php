<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Transformers\Multiplayer\RoomTransformer;

class SeasonsController extends Controller
{
    private function getJson($season, $params)
    {
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

        return [
            'cursor' => $hasMore ? $search['cursorHelper']->next($rooms) : null,
            'rooms' => json_collection($rooms, new RoomTransformer(), ['current_playlist_item.beatmap.beatmapset', 'difficulty_range', 'host', 'playlist_item_stats']),
            'search' => $search['search'],
            'type_group' => 'playlists',
        ];
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

        $seasons = Season::orderByDesc('id')->get();

        $params = get_params(request()->all(), null, [
            'cursor:array',
            'limit:int',
        ], ['null_missing' => true]);

        $roomsJson = $this->getJson($season, $params);

        if (is_json_request()) {
            return $roomsJson;
        }

        return ext_view('seasons.show', compact('roomsJson', 'season', 'seasons'));
    }
}
