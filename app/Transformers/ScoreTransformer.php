<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\DeletedUser;
use App\Models\LegacyMatch;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\Score\Model as ScoreModel;
use App\Models\Solo\Score as SoloScore;
use League\Fractal\Resource\Item;

class ScoreTransformer extends TransformerAbstract
{
    const USER_PROFILE_INCLUDES = ['beatmap', 'beatmapset', 'user'];
    const USER_PROFILE_INCLUDES_PRELOAD = [
        'beatmap',
        'beatmap.beatmapset',
        'user',
    ];

    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
        'current_user_attributes',
        'match',
        'rank_country',
        'rank_global',
        'user',
        'weight',
    ];

    protected $defaultIncludes = [
        'current_user_attributes',
    ];

    public function transform(LegacyMatch\Score|ScoreModel $score)
    {
        if ($score instanceof ScoreModel) {
            // this `best` relation is also used by `current_user_attributes` include.
            $best = $score->best;

            $createdAt = $score->date;
            $mode = $score->getMode();

            if ($best !== null) {
                $bestId = $best->getKey();
                $pp = $best->pp;
                $replay = $best->replay ?? false;
            }
        } else {
            // LegacyMatch\Score
            $createdAt = $score->game->start_time;
            $mode = $score->gameModeString();
        }

        $statistics = [
            'count_100' => $score->count100,
            'count_300' => $score->count300,
            'count_50' => $score->count50,
            'count_geki' => $score->countgeki,
            'count_katu' => $score->countkatu,
            'count_miss' => $score->countmiss,
        ];

        return [
            'accuracy' => $score->accuracy(),
            'best_id' => $bestId ?? null,
            'created_at' => json_time($createdAt),
            'id' => $score->getKey(),
            'max_combo' => $score->maxcombo,
            'mode' => $mode,
            'mode_int' => Beatmap::modeInt($mode),
            'mods' => $score->enabled_mods,
            'passed' => $score->pass,
            'perfect' => $score->perfect,
            'pp' => $pp ?? null,
            // Ranks are hardcoded to "0" for legacy match scores atm, return F instead for now.
            'rank' => $score->rank === '0' ? 'F' : $score->rank,
            'replay' => $replay ?? false,
            'score' => $score->score,
            'statistics' => $statistics,
            'user_id' => $score->user_id,
        ];
    }

    public function includeBeatmap(LegacyMatch\Score|ScoreModel $score)
    {
        $beatmap = $score->beatmap;

        if ($score->getMode() !== $beatmap->mode) {
            $beatmap->convert = true;
            $beatmap->playmode = Beatmap::MODES[$score->getMode()];
        }

        return $this->item($beatmap, new BeatmapTransformer());
    }

    public function includeBeatmapset(LegacyMatch\Score|ScoreModel $score)
    {
        return $this->item($score->beatmap->beatmapset, new BeatmapsetCompactTransformer());
    }

    public function includeCurrentUserAttributes(LegacyMatch\Score|ScoreModel|SoloScore $score): Item
    {
        return $this->item($score, new Score\CurrentUserAttributesTransformer());
    }

    public function includeMatch(LegacyMatch\Score $score)
    {
        return $this->primitive([
            'slot' => $score->slot,
            'team' => $score->team,
            'pass' => $score->pass,
        ]);
    }

    public function includeRankCountry(ScoreModel $score)
    {
        return $this->primitive($score->userRank(['type' => 'country']));
    }

    public function includeRankGlobal(ScoreModel $score)
    {
        return $this->primitive($score->userRank([]));
    }

    public function includeUser(LegacyMatch\Score|ScoreModel $score)
    {
        return $this->item(
            $score->user ?? new DeletedUser(['user_id' => $score->user_id]),
            new UserCompactTransformer()
        );
    }

    public function includeWeight(LegacyMatch\Score|ScoreModel $score)
    {
        if ($score instanceof ScoreBest && $score->weight !== null) {
            return $this->primitive([
                'percentage' => $score->weight * 100,
                'pp' => $score->weightedPp(),
            ]);
        }
    }
}
