<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapFailtimes;

class BeatmapTransformer extends BeatmapCompactTransformer
{
    protected $requiredPermission = 'BeatmapShow';

    public function __construct()
    {
        static $includes;

        if (!isset($includes)) {
            $includes = array_merge($this->availableIncludes, [
                'scoresBest',
                'failtimes',
                'max_combo',
            ]);
        }

        $this->availableIncludes = $includes;
    }

    public function transform(Beatmap $beatmap)
    {
        $result = parent::transform($beatmap);

        return array_merge($result, [
            'accuracy' => $beatmap->diff_overall,
            'ar' => $beatmap->diff_approach,
            'beatmapset_id' => $beatmap->beatmapset_id,
            'bpm' => $beatmap->bpm,
            'convert' => $beatmap->convert,
            'count_circles' => $beatmap->countNormal,
            'count_sliders' => $beatmap->countSlider,
            'count_spinners' => $beatmap->countSpinner,
            'count_total' => $beatmap->countTotal,
            'cs' => $beatmap->diff_size,
            'deleted_at' => $beatmap->deleted_at,
            'drain' => $beatmap->diff_drain,
            'hit_length' => $beatmap->hit_length,
            'is_scoreable' => $beatmap->isScoreable(),
            'last_updated' => json_time($beatmap->last_update),
            'mode_int' => $beatmap->playmode,
            'passcount' => $beatmap->passcount,
            'playcount' => $beatmap->playcount,
            'ranked' => $beatmap->approved,
            'status' => $beatmap->status(),
            'total_length' => $beatmap->total_length,
            'url' => route('beatmaps.show', ['beatmap' => $beatmap->beatmap_id]),
        ]);
    }

    public function includeBeatmapset(Beatmap $beatmap)
    {
        $beatmapset = $beatmap->beatmapset;

        return $beatmapset === null
            ? $this->primitive(null)
            : $this->primitive($beatmap->beatmapset, new BeatmapsetCompactTransformer);
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

    public function includeMaxCombo(Beatmap $beatmap)
    {
        $maxCombo = $beatmap->difficultyAttribs()
            ->mode($beatmap->playmode)
            ->noMods()
            ->maxCombo()
            ->first();

        return $this->primitive(optional($maxCombo)->value);
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
}
