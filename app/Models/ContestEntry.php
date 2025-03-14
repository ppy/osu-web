<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property-read Contest $contest
 * @property int $contest_id
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $entry_url
 * @property string|null $thumbnail_url
 * @property int $id
 * @property-read Collection<ContestJudgeVote> $judgeVotes
 * @property string $masked_name
 * @property string $name
 * @property-read Collection<ContestJudgeScore> $scores
 * @property \Carbon\Carbon|null $updated_at
 * @property-read User $user
 * @property int|null $user_id
 * @property-read Collection<ContestVote> $votes
 */
class ContestEntry extends Model
{
    public function scores(): HasManyThrough
    {
        return $this->hasManyThrough(ContestJudgeScore::class, ContestJudgeVote::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function judgeVotes(): HasMany
    {
        return $this->hasMany(ContestJudgeVote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votes()
    {
        return $this->hasMany(ContestVote::class);
    }

    public function thumbnail(): ?string
    {
        if (!$this->contest->hasThumbnails()) {
            return null;
        }

        return presence($this->thumbnail_url) ?? $this->entry_url;
    }

    public function totalScoreStd(): float
    {
        return $this->judgeVotes->map(fn (ContestJudgeVote $judgeVote) => $judgeVote->totalScoreStd())->sum();
    }
}
