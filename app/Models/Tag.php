<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property-read Collection<BeatmapTag> $beatmapTags
 */
class Tag extends Model
{
    protected $table = 'tags';

    public function beatmapTags(): HasMany
    {
        return $this->hasMany(BeatmapTag::class);
    }

    public static function topTags($beatmapId)
    {
        return static
            ::joinRelation(
                'beatmapTags',
                fn ($q) => $q->where('beatmap_id', $beatmapId)->whereHas('user', fn ($userQuery) => $userQuery->default())
            )
            ->groupBy('id')
            ->select('id', 'name')
            ->selectRaw('COUNT(*) as count')
            ->orderBy('count', 'desc')
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get();
    }
}
