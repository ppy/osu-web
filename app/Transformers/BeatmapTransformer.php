<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapFailtimes;

class BeatmapTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'scoresBest',
        'failtimes',
        'beatmapset',
        'max_combo',
    ];

    protected $requiredPermission = 'BeatmapShow';

    public function transform(Beatmap $beatmap)
    {
        return [
            'id' => $beatmap->beatmap_id,
            'beatmapset_id' => $beatmap->beatmapset_id,
            'mode' => $beatmap->mode,
            'mode_int' => $beatmap->playmode,
            'convert' => $beatmap->convert,
            'difficulty_rating' => $beatmap->difficultyrating,
            'version' => $beatmap->version,
            'total_length' => $beatmap->total_length,
            'hit_length' => $beatmap->hit_length,
            'bpm' => $beatmap->bpm,
            'cs' => $beatmap->diff_size,
            'drain' => $beatmap->diff_drain,
            'accuracy' => $beatmap->diff_overall,
            'ar' => $beatmap->diff_approach,
            'playcount' => $beatmap->playcount,
            'passcount' => $beatmap->passcount,
            'count_circles' => $beatmap->countNormal,
            'count_sliders' => $beatmap->countSlider,
            'count_spinners' => $beatmap->countSpinner,
            'count_total' => $beatmap->countTotal,
            'is_scoreable' => $beatmap->isScoreable(),
            'last_updated' => json_time($beatmap->last_update),
            'ranked' => $beatmap->approved,
            'status' => $beatmap->status(),
            'url' => route('beatmaps.show', ['beatmap' => $beatmap->beatmap_id]),
            'deleted_at' => $beatmap->deleted_at,
        ];
    }

    public function includeScoresBest(Beatmap $beatmap)
    {
        $scores = $beatmap
            ->scoresBest()
            ->default()
            ->visibleUsers()
            ->limit(config('osu.beatmaps.max-scores'))
            ->get();

        return $this->collection($scores, new ScoreTransformer);
    }

    public function includeFailtimes(Beatmap $beatmap)
    {
        $failtimes = $beatmap->failtimes;

        // adding a set of empty failtimes, so that the chart transitions
        // to 0 when a map has no failtimes (for now non-standard modes)
        if ($failtimes->isEmpty() || $beatmap->convert) {
            $failtimes = [
                new BeatmapFailtimes(['type' => 'fail']),
                new BeatmapFailtimes(['type' => 'exit']),
            ];
        }

        $result = [];

        foreach ($failtimes as $failtime) {
            $result[$failtime->type] = $failtime->data;
        }

        return $this->item($result, function ($result) {
            return $result;
        });
    }

    public function includeBeatmapset(Beatmap $beatmap)
    {
        $beatmapset = $beatmap->beatmapset;

        return $beatmapset === null
            ? $this->primitive(null)
            : $this->primitive($beatmap->beatmapset, new BeatmapsetTransformer);
    }

    public function includeMaxCombo(Beatmap $beatmap)
    {
        $maxCombo = $beatmap->difficultyAttribs()
            ->mode($beatmap->playmode)
            ->noMods()
            ->maxCombo()
            ->first();

        return $this->primitive(optional($maxCombo)->value);
    }
}
