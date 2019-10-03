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

use App\Models\ArtistTrack;
use League\Fractal;

class ArtistTrackTransformer extends Fractal\TransformerAbstract
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
