<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Models\Model;

/**
 * @property int $ruleset_id
 * @property int $old_score_id
 * @property int $score_id
 */
class ScoreLegacyIdMap extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['ruleset_id', 'old_score_id'];
    protected $table = 'solo_scores_legacy_id_map';

    public function getAttribute($key)
    {
        return match ($key) {
            'ruleset_id',
            'old_score_id',
            'score_id' => $this->getRawAttribute($key),
        };
    }
}
