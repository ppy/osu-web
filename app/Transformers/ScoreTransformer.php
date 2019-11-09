<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\Score\Model as ScoreModel;
use League\Fractal;

class ScoreTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
        'best',
        'weight',
        'user',
        'multiplayer',
    ];

    public function transform($score)
    {
        $ret = [
            'id' => $score->score_id,
            'user_id' => $score->user_id,
            'accuracy' => $score->accuracy(),
            'mods' => $score->enabled_mods,
            'score' => $score->score,
            'max_combo' => $score->maxcombo,
            'perfect' => $score->perfect,
            'statistics' => [
                'count_50' => $score->count50,
                'count_100' => $score->count100,
                'count_300' => $score->count300,
                'count_geki' => $score->countgeki,
                'count_katu' => $score->countkatu,
                'count_miss' => $score->countmiss,
            ],
            'pp' => $score->pp,
            // ranks are hardcoded to "0" for game_scores atm (i.e. scores from a mp game), return null instead for now
            'rank' => $score->rank === '0' ? null : $score->rank,
            'created_at' => json_time($score->date),
        ];

        if ($score instanceof ScoreModel) {
            $ret['mode'] = $score->getMode();
            $ret['mode_int'] = Beatmap::modeInt($score->getMode());
        }

        if ($score instanceof ScoreBest) {
            $ret['replay'] = $score->replay;
        }

        return $ret;
    }

    public function includeMultiplayer($score)
    {
        return $this->item($score, function ($score) {
            return [
                'slot' => $score->slot,
                'team' => $score->team,
                'pass' => $score->pass,
            ];
        });
    }

    public function includeBeatmap($score)
    {
        return $this->item($score->beatmap, new BeatmapTransformer);
    }

    public function includeBeatmapset($score)
    {
        return $this->item($score->beatmap->beatmapset, new BeatmapsetCompactTransformer);
    }

    public function includeBest($score)
    {
        if (($score instanceof ScoreBest) === true) {
            return;
        }

        return $this->item($score, function ($score) {
            return [
                'pp' => optional($score->best)->pp,
            ];
        });
    }

    public function includeWeight($score)
    {
        if (($score instanceof ScoreBest) === false) {
            return;
        }

        return $this->item($score, function ($score) {
            return [
                'percentage' => $score->weight * 100,
                'pp' => $score->weightedPp(),
            ];
        });
    }

    public function includeUser($score)
    {
        return $this->item($score->user, new UserCompactTransformer);
    }
}
