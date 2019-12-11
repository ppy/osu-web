<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * @property \Illuminate\Database\Eloquent\Collection $albums ArtistAlbum
 * @property string|null $bandcamp
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
 * @property int|null $user_id
 * @property int $visible
 * @property string|null $website
 * @property string|null $youtube
 */
class Artist extends Model
{
    private static $memoized = [];

    public function label()
    {
        return $this->belongsTo(Label::class);
    }

    public function albums()
    {
        return $this->hasMany(ArtistAlbum::class);
    }

    public function tracks()
    {
        return $this->hasMany(ArtistTrack::class);
    }

    public function hasNewTracks()
    {
        if (!array_key_exists('recentlyUpdatedArtists', self::$memoized)) {
            self::$memoized['recentlyUpdatedArtists'] =
                cache_remember_mutexed('recentlyUpdatedArtists', 300, [], function () {
                    return ArtistTrack::where('created_at', '>', Carbon::now()->subMonth(1))
                        ->select('artist_id')
                        ->groupBy('artist_id')
                        ->get()
                        ->pluck('artist_id')
                        ->toArray();
                });
        }

        return in_array($this->id, self::$memoized['recentlyUpdatedArtists'], true);
    }

    public function url()
    {
        return route('artists.show', $this);
    }
}
