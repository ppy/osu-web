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
    public $incrementing = false;

    protected $casts = [
        'elo_data' => 'array',
    ];
    protected $primaryKey = ':composite:';
    protected $primaryKeys = ['user_id', 'pool_id'];

    public function pool(): BelongsTo
    {
        return $this->belongsTo(MatchmakingPool::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeWithRank(Builder $query): Builder
    {
        $query->addSelect([
            'rank' => static
                ::selectRaw('COUNT(*) + 1')
                ->from($this->tableName(true), 'mus')
                ->whereColumn('rating', '>', $query->qualifyColumn('rating'))
                ->whereColumn('pool_id', '=', $query->qualifyColumn('pool_id')),
        ]);

        return $query;
    }

    public function scopeWhereRulesetId(Builder $query, int $rulesetId): Builder
    {
        return $query->whereHas('pool', fn ($q) => $q->where('ruleset_id', $rulesetId));
    }
}
