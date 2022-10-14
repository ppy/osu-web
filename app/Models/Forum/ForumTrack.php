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
    public $incrementing = false;
    public $timestamps = false;

    protected $dateFormat = 'U';
    protected $dates = ['mark_time'];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['forum_id', 'user_id'];
    protected $table = 'phpbb_forums_track';
}
