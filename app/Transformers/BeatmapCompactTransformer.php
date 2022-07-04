<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapFailtimes;

class BeatmapCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'accuracy',
        'ar',
        'beatmapset',
        'bpm',
        'checksum',
        'convert',
        'count_circles',
        'count_sliders',
        'count_spinners',
        'cs',
        'deleted_at',
        'drain',
        'failtimes',
        'hit_length',
        'is_scoreable',
        'last_updated',
        'max_combo',
        'mode_int',
        'passcount',
        'playcount',
        'ranked',
        'url',
    ];

    protected $beatmapsetTransformer = BeatmapsetCompactTransformer::class;

    public function transform(Beatmap $beatmap)
    {
        return [
            'beatmapset_id' => $beatmap->beatmapset_id,
            'difficulty_rating' => $beatmap->difficultyrating,
            'id' => $beatmap->beatmap_id,
            'mode' => $beatmap->mode,
            'status' => $beatmap->status(),
            'total_length' => $beatmap->total_length,
            'user_id' => $beatmap->user_id,
            'version' => $beatmap->version,
        ];
    }

    public function includeAccuracy(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->diff_overall);
    }

    public function includeAr(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->diff_approach);
    }

    public function includeBpm(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->bpm);
    }

    public function includeBeatmapset(Beatmap $beatmap)
    {
        $beatmapset = $beatmap->beatmapset;

        return $beatmapset === null
            ? $this->primitive(null)
            : $this->item($beatmap->beatmapset, new $this->beatmapsetTransformer());
    }

    public function includeChecksum(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->checksum);
    }


    public function includeConvert(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->convert);
    }

    public function includeCountCircles(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->countNormal);
    }

    public function includeCountSliders(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->countSlider);
    }

    public function includeCountSpinners(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->countSpinner);
    }

    public function includeCs(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->diff_size);
    }

    public function includeDeletedAt(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->deleted_at);
    }

    public function includeDrain(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->diff_drain);
    }

    public function includeFailtimes(Beatmap $beatmap)
    {
        $failtimes = $beatmap->failtimes;

        $result = [];

        foreach ($failtimes as $failtime) {
            $result[$failtime->type] = $failtime->data;
        }

        foreach (['exit', 'fail'] as $type) {
            if (!isset($result[$type])) {
                $result[$type] = (new BeatmapFailtimes())->data;
            }
        }

        return $this->primitive($result);
    }

    public function includeHitLength(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->hit_length);
    }

    public function includeIsScoreable(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->isScoreable());
    }

    public function includeLastUpdated(Beatmap $beatmap)
    {
        return $this->primitive(json_time($beatmap->last_update));
    }
    public function includeMaxCombo(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->maxCombo());
    }

    public function includeModeInt(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->playmode);
    }

    public function includePasscount(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->passcount);
    }

    public function includePlaycount(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->playcount);
    }

    public function includeRanked(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->approved);
    }

    public function includeUrl(Beatmap $beatmap)
    {
        return $this->primitive(route('beatmaps.show', ['beatmap' => $beatmap->beatmap_id]));
    }
}
