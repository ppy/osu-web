<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoreReplayStats extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'score_id';

    public function score(): BelongsTo
    {
        return $this->belongsTo(Solo\Score::class);
    }
}
