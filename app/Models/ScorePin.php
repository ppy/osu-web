<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property \App\Models\Solo\Score $score
 * @property \Carbon\Carbon|null $updated_at
 */
class ScorePin extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'score_id';

    public function scopeForRuleset($query, string $ruleset): Builder
    {
        return $query->where('ruleset_id', Beatmap::MODES[$ruleset]);
    }

    public function scopeWithVisibleScore($query): Builder
    {
        return $query->whereHas('score', fn ($q) => $q->whereHas('beatmap.beatmapset'));
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Solo\Score::class, 'score_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
