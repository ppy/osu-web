<?php

namespace App\Http\Controllers;

use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\SeasonTransformer;

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
        if ($id == 'latest') {
            $season = Season::last();
        } else {
            $season = Season::findOrFail($id);
        }

        $seasons = Season::orderByDesc('id')->get();

        $params = get_params(request()->all(), null, [
            'cursor:array',
            'limit:int',
        ], ['null_missing' => true]);

        $roomsJson = $this->getJson($season, $params);

        $selectOptions = [
            'currentItem' => json_item($season, new SeasonTransformer()),
            'items' => json_collection($seasons, new SeasonTransformer()),
            'type' => 'seasons',
        ];

        if (is_json_request()) {
            return $roomsJson;
        }

        return ext_view('seasons.show', compact('roomsJson', 'season', 'selectOptions'));
    }
}
