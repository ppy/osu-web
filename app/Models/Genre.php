<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Transformers\GenreTransformer;

/**
 * @property int $genre_id
 * @property string $name
 */
class Genre extends Model
{
    protected $table = 'osu_genres';
    protected $primaryKey = 'genre_id';
    public $timestamps = false;

    const UNSPECIFIED = 1;

    public static function listing()
    {
        return json_collection(static::all(), new GenreTransformer());
    }
}
