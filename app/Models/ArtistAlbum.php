<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Artist $artist
 * @property int|null $artist_id
 * @property string|null $cover_url
 * @property \Carbon\Carbon|null $created_at
 * @property string $genre
 * @property int $id
 * @property string $title
 * @property string|null $title_romanized
 * @property \Illuminate\Database\Eloquent\Collection $tracks ArtistTrack
 * @property \Carbon\Carbon|null $updated_at
 * @property int $visible
 */
class ArtistAlbum extends Model
{
    protected $casts = [
        'visible' => 'boolean',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function tracks()
    {
        return $this->hasMany(ArtistTrack::class, 'album_id');
    }

    public function isNew()
    {
        return $this->created_at->isAfter(now()->subMonth(1));
    }
}
