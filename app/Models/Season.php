<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property bool $concluded
 * @property string $name
 * @property-read Collection<Multiplayer\Room> $rooms
 */
class Season extends Model
{
    protected $casts = [
        'concluded' => 'boolean',
    ];

    public function scopeLatestOrId($query, $id)
    {
        if ($id === 'latest') {
            $season = $query->last();

            if ($season === null) {
                throw new ModelNotFoundException();
            }
        } else {
            $season = $query->findOrFail($id);
        }

        return $season;
    }

    public function endDate(): ?Carbon
    {
        return $this->concluded
            ? $this->rooms->max('ends_at')
            : null;
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
