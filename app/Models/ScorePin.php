<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Libraries\MorphMap;
use App\Models\Score\Best as ScoreBest;
use Ds\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property \App\Models\Score\Best\Model $score
 * @property \Carbon\Carbon|null $updated_at
 */
class ScorePin extends Model
{
    // TODO: make it an interface and check it in isValidType
    const SCORES = [
        MorphMap::MAP[ScoreBest\Fruits::class],
        MorphMap::MAP[ScoreBest\Mania::class],
        MorphMap::MAP[ScoreBest\Osu::class],
        MorphMap::MAP[ScoreBest\Taiko::class],
    ];

    public static function isValidType(string|null $type): bool
    {
        static $lookup;

        $lookup ??= new Set(static::SCORES);

        return $lookup->contains($type);
    }

    public function scopeForMode($query, string|Score\Best\Model $modeOrScore): Builder
    {
        if (is_string($modeOrScore)) {
            $class = Score\Best\Model::getClassByString($modeOrScore);
            $instance = new $class();
        } else {
            $instance = $modeOrScore;
        }

        return $query->where('score_type', $instance->getMorphClass());
    }

    public function scopeWithVisibleScore($query): Builder
    {
        return $query->whereHas('score', fn ($q) => $q->visibleUsers());
    }

    public function score(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
