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
    const SCORES = [
        MorphMap::MAP[ScoreBest\Fruits::class],
        MorphMap::MAP[ScoreBest\Mania::class],
        MorphMap::MAP[ScoreBest\Osu::class],
        MorphMap::MAP[ScoreBest\Taiko::class],
        MorphMap::MAP[Solo\Score::class],
    ];

    public static function isValidType(string|null $type): bool
    {
        static $lookup;

        $lookup ??= new Set(static::SCORES);

        return $lookup->contains($type);
    }

    public function scopeForRuleset($query, string $ruleset): Builder
    {
        return $query->where('ruleset_id', Beatmap::MODES[$ruleset]);
    }

    public function scopeWithVisibleScore($query): Builder
    {
        $scoreModels = static::SCORES;

        if (config('osu.user.hide_pinned_solo_scores')) {
            $soloScoreIndex = array_search_null(MorphMap::MAP[Solo\Score::class], $scoreModels);
            array_splice($scoreModels, $soloScoreIndex, 1);
        }

        return $query->whereHasMorph('score', $scoreModels, fn ($q) => $q->whereHas('beatmap.beatmapset'));
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
