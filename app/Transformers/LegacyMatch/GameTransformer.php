<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\LegacyMatch;

use App\Models\LegacyMatch\Game;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\ScoreTransformer;
use App\Transformers\TransformerAbstract;

class GameTransformer extends TransformerAbstract
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
            return $this->item($game->beatmap, new BeatmapCompactTransformer());
        }
    }

    public function includeScores(Game $game)
    {
        return $this->collection(
            $game->scores,
            new ScoreTransformer()
        );
    }
}
