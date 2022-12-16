<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property bool $concluded
 * @property string $name
 */
class Season extends Model
{
    protected $casts = [
        'concluded' => 'boolean',
    ];

    public function endDate(): ?Carbon
    {
        if ($this->hasRooms() && $this->concluded) {
            return $this->rooms->sortByDesc('id')->first()->ends_at;
        }
    }

    public function hasRooms(): bool
    {
        return $this->rooms()->count() > 0;
    }

    public function startDate(): ?Carbon
    {
        if ($this->hasRooms()) {
            return $this->rooms->sortBy('id')->first()->starts_at;
        }
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Multiplayer\Room::class, SeasonRoom::class);
    }
}
