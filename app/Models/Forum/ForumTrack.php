<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Casts\TimestampOrZero;

/**
 * @property int $forum_id
 * @property \Carbon\Carbon|null $mark_time
 * @property int $user_id
 */
class ForumTrack extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = ['mark_time' => TimestampOrZero::class];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['forum_id', 'user_id'];
    protected $table = 'phpbb_forums_track';
}
