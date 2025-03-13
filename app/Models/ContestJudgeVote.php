<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Collection<ContestJudgeScore> $scores
 * @property string|null $comment
 * @property int $contest_entry_id
 * @property \Carbon\Carbon|null $created_at
 * @property-read ContestEntry $entry
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property-read User $user
 * @property int $user_id
 */
class ContestJudgeVote extends Model
{
    public function scores(): HasMany
    {
        return $this->hasMany(ContestJudgeScore::class);
    }

    public function entry(): BelongsTo
    {
        return $this->belongsTo(ContestEntry::class, 'contest_entry_id');
    }

    public function totalScore(): int
    {
        return intval($this->scores()->sum('value'));
    }

    public function totalScoreStd(): float
    {
        [$stdDev, $mean] = ContestJudge::where(['contest_id' => $this->entry->contest_id, 'user_id' => $this->user_id])->first()->stdDev();

        return ($this->totalScore() - $mean) / $stdDev;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
