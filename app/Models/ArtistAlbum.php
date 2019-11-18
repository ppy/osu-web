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
