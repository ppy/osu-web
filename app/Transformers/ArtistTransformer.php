<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Artist;

class ArtistTransformer extends TransformerAbstract
{
    public function transform(Artist $artist)
    {
        return [
            'id' => $artist->getKey(),
            'name' => $artist->name,
        ];
    }
}
