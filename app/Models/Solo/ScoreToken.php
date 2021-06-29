<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Solo;

use App\Models\Model;

/**
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $ruleset_id
 * @property \App\Models\Solo\Score $score
 * @property int $score_id
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 */
class ScoreToken extends Model
{
    protected $table = 'solo_score_tokens';

    public function score()
    {
        return $this->belongsTo(Score::class);
    }
}
