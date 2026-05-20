<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score\Best;

use App\Models\Score\Model as BaseModel;

abstract class Model extends BaseModel
{
    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'count100',
            'count300',
            'count50',
            'countgeki',
            'countkatu',
            'countmiss',
            'country_acronym',
            'maxcombo',
            'pp',
            'rank',
            'score',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'hidden',
            'perfect',
            'replay' => (bool) $this->getRawAttribute($key),

            'date' => $this->getTimeFast($key),

            'date_json' => $this->getJsonTimeFast($key),

            'best' => $this,
            'enabled_mods' => $this->getEnabledModsAttribute($this->getRawAttribute('enabled_mods')),
            'pass' => true,

            'best_id' => $this->getKey(),

            'beatmap',
            'reportedIn',
            'user' => $this->getRelationValue($key),
        };
    }
}
