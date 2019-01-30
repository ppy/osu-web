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

namespace App\Transformers\API;

use App\Models\Multiplayer\Game;
use League\Fractal;

class GameTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = ['scores'];

    public function transform(Game $game)
    {
        return [
            'game_id' => $game->game_id,
            'start_time' => $game->start_time ? $game->start_time->tz('Australia/Perth')->toDateTimeString() : null,
            'end_time' => $game->end_time ? $game->end_time->tz('Australia/Perth')->toDateTimeString() : null,
            'beatmap_id' => $game->beatmap_id,
            'play_mode' => $game->play_mode,
            'match_type' => $game->match_type,
            'scoring_type' => $game->scoring_type,
            'team_type' => $game->team_type,
            'mods' => $game->mods,
        ];
    }

    public function includeScores(Game $game)
    {
        return $this->collection(
            $game->scores,
            new Multiplayer\ScoreTransformer()
        );
    }
}
