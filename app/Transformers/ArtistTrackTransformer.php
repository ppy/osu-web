<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ArtistTrack;

class ArtistTrackTransformer extends TransformerAbstract
{
    public function transform(ArtistTrack $track)
    {
        return [
            'id' => $track->id,
            'album_id' => $track->album_id,
            'title' => $track->title,
            'version' => $track->version,
            'length' => format_duration_for_display($track->length),
            'exclusive' => $track->exclusive,
            'is_new' => $track->isNew(),
            'bpm' => $track->bpm,
            'genre' => $track->genre,
            'preview' => $track->preview,
            'cover_url' => $track->cover_url,
            'osz' => $track->osz,
        ];
    }
}
