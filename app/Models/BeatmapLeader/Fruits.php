<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\BeatmapLeader;

use App\Models\Score;

/**
 * @property int $beatmap_id
 * @property Score\Fruits $score
 * @property int|null $score_id
 * @property int $user_id
 */
class Fruits extends Model
{
    protected $table = 'osu_leaders_fruits';

    public function score()
    {
        return $this->belongsTo(Score\Fruits::class, 'score_id');
    }
}
