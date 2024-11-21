<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property-read Beatmap $beatmap
 * @property int $beatmap_id
 * @property int $tag_id
 * @property-read User $user
 * @property int $user_id
 */
class BeatmapTag extends Model
{
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['beatmap_id', 'tag_id', 'user_id'];

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
