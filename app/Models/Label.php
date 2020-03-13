<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property \Illuminate\Database\Eloquent\Collection $artists Artist
 * @property \Carbon\Carbon|null $created_at
 * @property string $description
 * @property string $header_url
 * @property string $icon_url
 * @property int $id
 * @property string $name
 * @property string|null $soundcloud
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $website
 */
class Label extends Model
{
    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
