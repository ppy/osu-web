<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapFailtimes;

class BeatmapCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmapset',
        'checksum',
        'scoresBest',
        'failtimes',
        'max_combo',
    ];

    protected $beatmapsetTransformer = BeatmapsetCompactTransformer::class;

    public function transform(Beatmap $beatmap)
    {
        return [
            'difficulty_rating' => $beatmap->difficultyrating,
            'id' => $beatmap->beatmap_id,
            'mode' => $beatmap->mode,
            'version' => $beatmap->version,
        ];
    }

    public function includeBeatmapset(Beatmap $beatmap)
    {
        $beatmapset = $beatmap->beatmapset;

        return $beatmapset === null
            ? $this->primitive(null)
            : $this->item($beatmap->beatmapset, new $this->beatmapsetTransformer);
    }

    public function includeChecksum(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->checksum);
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

        return $this->primitive($result);
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
