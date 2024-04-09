<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Models\Model;

/**
 * @property int $score_id
 * @property int $processed_version
 * @property \Carbon\Carbon $processed_at
 */
class ScoreProcessHistory extends Model
{
    protected $table = 'score_process_history';

    public function score()
    {
        return $this->belongsTo(Score::class, 'score_id');
    }
}