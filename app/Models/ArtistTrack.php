<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\Elasticsearch\Indexable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property ArtistAlbum $album
 * @property int|null $album_id
 * @property Artist $artist
 * @property int|null $artist_id
 * @property float $bpm
 * @property string|null $cover_url
 * @property \Carbon\Carbon|null $created_at
 * @property int|null $display_order
 * @property bool $exclusive
 * @property string $genre
 * @property int $id
 * @property int $length
 * @property string $osz
 * @property string $preview
 * @property string $title
 * @property string|null $title_romanized
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $version
 */
class ArtistTrack extends Model implements Indexable
{
    use Elasticsearch\ArtistTrackTrait, HasFactory;

    protected $casts = [
        'exclusive' => 'boolean',
    ];

    protected $casts = [
        'exclusive' => 'boolean',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function album()
    {
        return $this->belongsTo(ArtistAlbum::class);
    }

    public function getCoverUrlAttribute($value)
    {
        if (present($value)) {
            return $value;
        }

        return $this->album_id ? $this->album->cover_url : $this->artist->cover_url;
    }

    public function isNew()
    {
        return $this->created_at->isAfter(now()->subMonth(1));
    }
}
