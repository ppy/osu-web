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

namespace App\Transformers;

use App\Models\ArtistAlbum;
use League\Fractal;

class ArtistAlbumTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'tracks',
    ];

    public function transform(ArtistAlbum $album)
    {
        return [
            'id' => $album->id,
            'artist_id' => $album->artist_id,
            'title' => $album->title,
            'title_romanized' => $album->title_romanized,
            'genre' => $album->genre,
            'is_new' => $album->isNew(),
            'cover_url' => $album->cover_url,
        ];
    }

    public function includeTracks(ArtistAlbum $album)
    {
        return $this->collection($album->tracks, new ArtistTrackTransformer);
    }
}
