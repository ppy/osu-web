<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\DeletedUser;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\Score\Model as ScoreModel;

class ScoreTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
        'rank_country',
        'rank_global',
        'weight',
        'user',
        'match',
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
            'passed' => $score->pass,
            'perfect' => $score->perfect,
            'statistics' => [
                'count_50' => $score->count50,
                'count_100' => $score->count100,
                'count_300' => $score->count300,
                'count_geki' => $score->countgeki,
                'count_katu' => $score->countkatu,
                'count_miss' => $score->countmiss,
            ],
            // ranks are hardcoded to "0" for game_scores atm (i.e. scores from a mp game), return null instead for now
            'rank' => $score->rank === '0' ? null : $score->rank,
            'created_at' => json_time($score->date),
        ];

        $best = $score instanceof ScoreBest ? $score : $score->best;

        if ($best === null) {
            $ret['best_id'] = null;
            $ret['pp'] = null;
        } else {
            $ret['best_id'] = $best->getKey();
            $ret['pp'] = $best->pp;
        }

        if ($score instanceof ScoreModel) {
            $ret['mode'] = $score->getMode();
            $ret['mode_int'] = Beatmap::modeInt($score->getMode());
            $ret['replay'] = $score->best->replay ?? false;
        }

        if ($score instanceof ScoreBest) {
            $ret['replay'] = $score->replay;
        }

        return $ret;
    }

    public function includeMatch($score)
    {
        return $this->primitive([
            'slot' => $score->slot,
            'team' => $score->team,
            'pass' => $score->pass,
        ]);
    }

    public function includeRankCountry($score)
    {
        return $this->primitive($score->userRank(['type' => 'country']));
    }

    public function includeRankGlobal($score)
    {
        return $this->primitive($score->userRank([]));
    }

    public function includeBeatmap($score)
    {
        if ($score->beatmap === null) {
            return $this->primitive(null);
        }

        if ($score->getMode() !== $score->beatmap->mode) {
            $score->beatmap->convert = true;
            $score->beatmap->playmode = Beatmap::MODES[$score->getMode()];
        }

        return $this->item($score->beatmap, new BeatmapTransformer());
    }

    public function includeBeatmapset($score)
    {
        return $this->item($score->beatmap->beatmapset, new BeatmapsetCompactTransformer());
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
        $user = $score->user ?? new DeletedUser(['user_id' => $score->user_id]);

        return $this->item($user, new UserCompactTransformer());
    }
}
