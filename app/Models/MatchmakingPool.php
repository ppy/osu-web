<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool $active
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $lobby_size
 * @property string $name
 * @property int $rating_search_radius
 * @property int $rating_search_radius_exp
 * @property int $ruleset_id
 * @property \Carbon\Carbon|null $updated_at
 * @property int $variant_id
 * @property-read \Illuminate\Database\Eloquent\Collection<MatchmakingUserStats> $allUserStats
 */
class MatchmakingPool extends Model
{
    protected $casts = [
        'active' => 'bool',
    ];

    public function allUserStats(): HasMany
    {
        return $this->hasMany(MatchmakingUserStats::class, 'pool_id');
    }
}
