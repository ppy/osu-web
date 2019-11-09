<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

class Notification extends Model
{
    const BEATMAPSET_DISCUSSION_LOCK = 'beatmapset_discussion_lock';
    const BEATMAPSET_DISCUSSION_POST_NEW = 'beatmapset_discussion_post_new';
    const BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM = 'beatmapset_discussion_qualified_problem';
    const BEATMAPSET_DISCUSSION_UNLOCK = 'beatmapset_discussion_unlock';
    const BEATMAPSET_DISQUALIFY = 'beatmapset_disqualify';
    const BEATMAPSET_LOVE = 'beatmapset_love';
    const BEATMAPSET_NOMINATE = 'beatmapset_nominate';
    const BEATMAPSET_QUALIFY = 'beatmapset_qualify';
    const BEATMAPSET_RANK = 'beatmapset_rank';
    const BEATMAPSET_RESET_NOMINATIONS = 'beatmapset_reset_nominations';
    const CHANNEL_MESSAGE = 'channel_message';
    const COMMENT_NEW = 'comment_new';
    const FORUM_TOPIC_REPLY = 'forum_topic_reply';
    const USER_ACHIEVEMENT_UNLOCK = 'user_achievement_unlock';

    const SUBTYPES = [
        'comment_new' => 'comment',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function source()
    {
        return $this->belongsTo(User::class);
    }

    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
