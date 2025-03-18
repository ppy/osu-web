<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeWithScore(Builder $query, Contest $contest): Builder
    {
        $orderValue = 'votes_count';

        if ($contest->isBestOf()) {
            $query
                ->selectRaw('*')
                ->selectRaw('(SELECT FLOOR(SUM(`weight`)) FROM `contest_votes` WHERE `contest_entries`.`id` = `contest_votes`.`contest_entry_id`) AS votes_count')
                ->limit(50); // best of contests tend to have a _lot_ of entries...
        } else if ($contest->isJudged()) {
            $query->withSum('scores', 'value');
            $orderValue = 'scores_sum_value';
        } else {
            $query->withCount('votes');
        }

        return $query->orderBy($orderValue, 'desc');
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
