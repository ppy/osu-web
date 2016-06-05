<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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

use League\Fractal;
use App\Models\Multiplayer\Game;
use App\Models\Beatmap;
use App\Transformers;

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
            'start_time' => $game->start_time->toIso8601String(),
            'end_time' => $game->end_time ? $game->end_time->toIso8601String() : null,
            'mode' => Beatmap::modeStr($game->play_mode),
            'mode_int' => $game->play_mode,
            'scoring_type' => $game->scoring_type,
            'team_type' => $game->team_type,
            'mods' => $game->mods,
        ];
    }

    public function includeBeatmap(Game $game)
    {
        return $this->item($game->beatmap, new Transformers\BeatmapTransformer);
    }

    public function includeScores(Game $game)
    {
        return $this->collection(
            $game->scores, new Transformers\ScoreTransformer
        );
    }
}
