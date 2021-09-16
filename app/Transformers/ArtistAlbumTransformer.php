<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ArtistAlbum;

class ArtistAlbumTransformer extends TransformerAbstract
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
        return $this->collection($album->tracks, new ArtistTrackTransformer());
    }
}
