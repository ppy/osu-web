<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

/**
 * @property int $forum_id
 * @property int $mark_time
 * @property int $user_id
 */
class ForumTrack extends Model
{
    protected $table = 'phpbb_forums_track';

    public $timestamps = false;
    protected $dates = ['mark_time'];
    protected $dateFormat = 'U';

    protected $primaryKeys = ['forum_id', 'user_id'];
}
