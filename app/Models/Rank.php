<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $rank_id
 * @property string $rank_image
 * @property int $rank_min
 * @property int $rank_special
 * @property string $rank_title
 * @property string|null $url
 */
class Rank extends Model
{
    protected $table = 'phpbb_ranks';
    protected $primaryKey = 'rank_id';
    public $timestamps = false;

    public function getRankTitleAttribute($value)
    {
        return presence($value);
    }
}
