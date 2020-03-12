<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property \Carbon\Carbon|null $awarded
 * @property string $description
 * @property string $image
 * @property string $url
 * @property int $user_id
 */
class UserBadge extends Model
{
    protected $table = 'osu_badges';
    protected $primaryKey = 'user_id';

    protected $dates = ['awarded'];
    public $timestamps = false;

    public function imageUrl()
    {
        return "https://assets.ppy.sh/profile-badges/{$this->image}";
    }
}
