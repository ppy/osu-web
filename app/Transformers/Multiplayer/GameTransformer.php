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

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\Game;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\ScoreTransformer;
use League\Fractal;

class GameTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'scores',
    ];

    public function transform(Game $game)
    {
        return [
            'id' => $game->game_id,
            'start_time' => json_time($game->start_time),
            'end_time' => json_time($game->end_time),
            'mode' => $game->mode,
            'mode_int' => $game->play_mode,
            'scoring_type' => $game->scoring_type,
            'team_type' => $game->team_type,
            'mods' => $game->mods,
        ];
    }

    public function includeBeatmap(Game $game)
    {
        if ($game->beatmap) {
            return $this->item($game->beatmap, new BeatmapCompactTransformer);
        }
    }

    public function includeScores(Game $game)
    {
        return $this->collection(
            $game->scores, new ScoreTransformer
        );
    }
}
