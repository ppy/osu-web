<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $mode
 * @property int $rank
 * @property \Carbon\Carbon $updated_at
 * @property-read string $updated_at_json
 * @property-read User $user
 * @property int $user_id
 */
class RankHighest extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = ['updated_at' => 'datetime'];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'mode'];
    protected $table = 'osu_user_performance_rank_highest';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'mode',
            'rank',
            'user_id' => $this->getRawAttribute($key),

            'updated_at' => $this->getTimeFast($key),

            'updated_at_json' => $this->getJsonTimeFast($key),

            'user' => $this->getRelationValue($key),
        };
    }
}
