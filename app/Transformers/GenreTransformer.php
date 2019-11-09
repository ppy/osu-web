<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\Genre;
use League\Fractal;

class GenreTransformer extends Fractal\TransformerAbstract
{
    public function transform(Genre $genre)
    {
        return [
            'id' => $genre->genre_id === 0 ? null : $genre->genre_id,
            'name' => trans('beatmaps.genre.'.str_replace(' ', '-', strtolower($genre->name))),
        ];
    }
}
