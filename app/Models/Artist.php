<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Traits\Memoizes;

/**
 * @property \Illuminate\Database\Eloquent\Collection $albums ArtistAlbum
 * @property string|null $alternative_name
 * @property string|null $bandcamp
 * @property \Illuminate\Database\Eloquent\Collection $beatmapsets Beatmapset
 * @property string|null $cover_url
 * @property \Carbon\Carbon|null $created_at
 * @property string $description
 * @property string|null $facebook
 * @property string|null $header_url
 * @property int $id
 * @property Label $label
 * @property int|null $label_id
 * @property string $name
 * @property string|null $patreon
 * @property string|null $soundcloud
 * @property string|null $spotify
 * @property \Illuminate\Database\Eloquent\Collection $tracks ArtistTrack
 * @property string|null $twitter
 * @property \Carbon\Carbon|null $updated_at
 * @property bool $use_for_linking
 * @property int|null $user_id
 * @property string|null $video_url
 * @property int $visible
 * @property string|null $website
 * @property string|null $youtube
 */
class Artist extends Model
{
    use Memoizes;

    protected $casts = [
        'use_for_linking' => 'boolean',
        'visible' => 'boolean',
    ];

    public function label()
    {
        return $this->belongsTo(Label::class);
    }

    public function albums()
    {
        return $this->hasMany(ArtistAlbum::class);
    }

    public function beatmapsets()
    {
        return $this->hasManyThrough(Beatmapset::class, ArtistTrack::class, null, 'track_id');
    }

    public function tracks()
    {
        return $this->hasMany(ArtistTrack::class);
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'alternative_name',
            'bandcamp',
            'cover_url',
            'description',
            'facebook',
            'header_url',
            'id',
            'label_id',
            'name',
            'patreon',
            'soundcloud',
            'spotify',
            'twitter',
            'user_id',
            'video_url',
            'website',
            'youtube' => $this->getRawAttribute($key),

            'created_at',
            'updated_at' => $this->getTimeFast($key),

            'use_for_linking',
            'visible' => (bool) $this->getRawAttribute($key),

            'albums',
            'beatmapsets',
            'label',
            'tracks' => $this->getRelationValue($key),
        };
    }

    /**
     * This requires querying the model with `->withMax('tracks', 'created_at')`.
     */
    public function hasNewTracks()
    {
        $date = parse_time_to_carbon($this->attributes['tracks_max_created_at']);

        return $date !== null && $date->addMonths(1)->isFuture();
    }

    public function url()
    {
        return route('artists.show', $this);
    }
}
