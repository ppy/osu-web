<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Transformers\SeasonTransformer;
use App\Transformers\SelectOptionTransformer;

class SeasonsController extends Controller
{
    public function rooms($id)
    {
        $params = $this->paramsForResponse($id, request()->all());
        $roomsJson = Room::responseJson($params);

        return $roomsJson;
    }

    public function show($id)
    {
        $season = Season::latestOrId($id);

        $params = $this->paramsForResponse($season->getKey());
        $roomsJson = Room::responseJson($params);

        $seasonJson = json_item($season, new SeasonTransformer());

        $seasons = Season::orderByDesc('id')->get();
        $seasonsJson = json_collection($seasons, new SelectOptionTransformer());

        return ext_view('seasons.show', compact('roomsJson', 'season', 'seasonJson', 'seasonsJson'));
    }

    private function paramsForResponse(int $seasonId, ?array $rawParams = null)
    {
        return [
            'cursor' => cursor_from_params($rawParams),
            'limit' => get_int($rawParams['limit'] ?? null),
            'mode' => 'all',
            'season_id' => $seasonId,
        ];
    }
}
