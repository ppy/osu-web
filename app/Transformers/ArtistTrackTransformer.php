<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ArtistTrack;

class ArtistTrackTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'album',
        'artist',
    ];

    public function transform(ArtistTrack $track)
    {
        return [
            'album_id' => $track->album_id,
            'artist_id' => $track->artist_id,
            'bpm' => $track->bpm,
            'cover_url' => $track->cover_url,
            'exclusive' => $track->exclusive,
            'genre' => $track->genre,
            'id' => $track->id,
            'is_new' => $track->isNew(),
            'length' => format_duration_for_display($track->length),
            'osz' => $track->osz,
            'preview' => $track->preview,
            'title' => $track->title,
            'updated_at' => json_time($track->updated_at),
            'version' => $track->version,
        ];
    }

    public function includeAlbum(ArtistTrack $track)
    {
        $album = $track->album;

        return $album === null
            ? null
            : $this->item($track->album, new ArtistAlbumTransformer());
    }

    public function includeArtist(ArtistTrack $track)
    {
        return $this->item($track->artist, new ArtistTransformer());
    }
}
