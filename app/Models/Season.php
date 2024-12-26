<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool $finalised
 * @property string $name
 * @property-read Collection<Multiplayer\Room> $rooms
 * @property string|null $url
 */
class Season extends Model
{
    protected $casts = [
        'finalised' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('finalised', false);
    }

    public static function latestOrId($id)
    {
        if ($id === 'latest') {
            $season = static::last();

            if ($season === null) {
                throw new ModelNotFoundException();
            }
        } else {
            $season = static::findOrFail($id);
        }

        return $season;
    }

    public function endDate(): ?Carbon
    {
        return $this->finalised
            ? $this->rooms->max('ends_at')
            : null;
    }

    public function scoreFactors(): HasMany
    {
        return $this->hasMany(SeasonScoreFactor::class);
    }

    public function scoreFactorsOrderedForCalculation(): array
    {
        return cache_remember_mutexed(
            "score_factors:{$this->id}",
            $GLOBALS['cfg']['osu']['seasons']['factors_cache_duration'],
            [],
            function () {
                return $this->scoreFactors()
                    ->orderByDesc('factor')
                    ->get()
                    ->pluck('factor')
                    ->toArray();
            }
        );
    }

    public function startDate(): ?Carbon
    {
        return $this->rooms->min('starts_at');
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Multiplayer\Room::class, SeasonRoom::class);
    }
}
