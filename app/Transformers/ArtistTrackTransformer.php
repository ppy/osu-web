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
            'album_id' => $track->album_id,
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
            'version' => $track->version,
        ];
    }
}
