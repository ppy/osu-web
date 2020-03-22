<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\API;

use App\Models\Multiplayer\Game;
use App\Transformers\TransformerAbstract;

class GameTransformer extends TransformerAbstract
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
