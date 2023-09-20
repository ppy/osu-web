<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Genre;

class GenreTransformer extends TransformerAbstract
{
    public function transform(Genre $genre)
    {
        $id = $genre->getKey();

        return [
            'id' => $id === 0 ? null : $id,
            'name' => osu_trans('beatmaps.genre.'.strtr(strtolower($genre->name), ' ', '-')),
        ];
    }
}
