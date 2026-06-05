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
    const MIN_SIG_PROVISIONAL = 100;

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
        // this won't be accurate when there are restricted users
        $rankQuery = new static()
            ->newQuery()
            ->from($this->tableName(true), 'mus')
            ->selectRaw('COUNT(*) + 1')
            ->where('plays', '>', 0)
            ->whereColumn('rating', '>', $query->qualifyColumn('rating'))
            ->whereColumn('pool_id', '=', $query->qualifyColumn('pool_id'));

        $query->addSelect(['rank' => $rankQuery]);
    }

    public function scopeWhereRulesetId(Builder $query, int $rulesetId): Builder
    {
        return $query->whereHas('pool', fn ($q) => $q->where('ruleset_id', $rulesetId));
    }

    public function isRatingProvisional(): bool
    {
        return $this->elo_data['approximate_posterior']['sig'] >= static::MIN_SIG_PROVISIONAL;
    }

    public function rank(): int
    {
        return 1 + static::default()
            ->where('rating', '>', $this->rating)
            ->where('pool_id', $this->pool_id)
            ->count();
    }
}
