<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \Illuminate\Database\Eloquent\Collection $categoryVotes
 * @property string|null $comment
 * @property int $contest_entry_id
 * @property \Carbon\Carbon|null $created_at
 * @property ContestEntry $entry
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class ContestJudgeVote extends Model
{
    public function categoryVotes(): HasMany
    {
        return $this->hasMany(ContestJudgeCategoryVote::class);
    }

    public function entry(): BelongsTo
    {
        return $this->belongsTo(ContestEntry::class, 'contest_entry_id');
    }

    public function score(): int
    {
        return intval($this->categoryVotes()->sum('value'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
