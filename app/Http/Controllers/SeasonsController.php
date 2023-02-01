<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Transformers\SeasonTransformer;

class SeasonsController extends Controller
{
    public function rooms($id)
    {
        $season = Season::latestOrId($id);

        $params = $this->paramsForResponse(request()->all(), $season);
        $roomsJson = Room::responseJson($params, false);

        return $roomsJson;
    }

    public function show($id)
    {
        $season = Season::latestOrId($id);

        $params = $this->paramsForResponse(request()->all(), $season);
        $roomsJson = Room::responseJson($params, false);

        $seasonJson = json_item($season, new SeasonTransformer(), ['end_date', 'start_date']);

        $seasons = Season::orderByDesc('id')->get();
        $seasonsJson = json_collection($seasons, new SeasonTransformer());

        return ext_view('seasons.show', compact('roomsJson', 'seasonJson', 'seasonsJson'));
    }

    private function paramsForResponse($rawParams, $season)
    {
        return [
            'cursor' => cursor_from_params($rawParams),
            'limit' => get_int($rawParams['limit'] ?? null),
            'mode' => 'all',
            'season_id' => $season->getKey(),
        ];
    }
}
