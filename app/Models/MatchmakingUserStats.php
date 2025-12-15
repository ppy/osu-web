<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property array $elo_data
 * @property int $first_placements
 * @property int $pool_id
 * @property int $rating
 * @property int $total_points
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class MatchmakingUserStats extends Model
{
    const MIN_PLAYS_NON_PROVISIONAL = 5;

    public $incrementing = false;

    protected $casts = [
        'elo_data' => 'array',
    ];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'pool_id'];

    public function pool(): BelongsTo
    {
        return $this->belongsTo(MatchmakingPool::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query
            ->whereHas('user', fn (Builder $q): Builder => $q->default())
            ->where('plays', '>', 0);
    }

    public function scopeWithRank(Builder $query): void
    {
        $rankQuery = new static()
            // mainly so whereHas in default() uses the correct table alias
            ->setTable('mus')
            ->newQuery()
            ->from($this->tableName(true), 'mus')
            ->selectRaw('COUNT(*) + 1')
            ->default()
            ->whereColumn('rating', '>', $query->qualifyColumn('rating'))
            ->whereColumn('pool_id', '=', $query->qualifyColumn('pool_id'));

        $query->addSelect(['rank' => $rankQuery]);
    }

    public function scopeWhereRulesetId(Builder $query, int $rulesetId): Builder
    {
        return $query->whereHas('pool', fn ($q) => $q->where('ruleset_id', $rulesetId));
    }
}
