<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read ContestScoringCategory $category
 * @property int $contest_scoring_category_id
 * @property int $contest_judge_vote_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property int $value
 * @property-read ContestJudgeVote $vote
 */
class ContestJudgeScore extends Model
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(ContestScoringCategory::class, 'contest_scoring_category_id');
    }

    public function vote(): BelongsTo
    {
        return $this->belongsTo(ContestJudgeVote::class, 'contest_judge_vote_id');
    }

    public function scopeScoresByEntry(Builder $query)
    {
        return $query->groupBy('contest_judge_vote_id')
            ->select('contest_judge_vote_id')
            ->addSelect(\DB::raw('SUM(value) as total'));
    }
}
