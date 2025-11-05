<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property int $ruleset_id
 * @property int $variant_id
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @property bool $active
 * @property int $lobby_size
 * @property int $rating_search_radius
 * @property int $rating_search_radius_exp
 * @property-read \Illuminate\Database\Eloquent\Collection<MatchmakingUserStats> $allUserStats
 */
class MatchmakingPool extends Model
{
    public function allUserStats(): HasMany
    {
        return $this->hasMany(MatchmakingUserStats::class, 'pool_id');
    }
}
