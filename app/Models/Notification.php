<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use App\Models\Chat\Channel;
use App\Models\Forum\Topic;

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

    const NAME_TO_CATEGORY = [
        self::BEATMAPSET_DISCUSSION_LOCK => 'beatmapset_discussion',
        self::BEATMAPSET_DISCUSSION_POST_NEW => 'beatmapset_discussion',
        self::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM => 'beatmapset_problem',
        self::BEATMAPSET_DISCUSSION_UNLOCK => 'beatmapset_discussion',
        self::BEATMAPSET_DISQUALIFY => 'beatmapset_state',
        self::BEATMAPSET_LOVE => 'beatmapset_state',
        self::BEATMAPSET_NOMINATE => 'beatmapset_state',
        self::BEATMAPSET_QUALIFY => 'beatmapset_state',
        self::BEATMAPSET_RANK => 'beatmapset_state',
        self::BEATMAPSET_RESET_NOMINATIONS => 'beatmapset_state',
        self::CHANNEL_MESSAGE => 'channel',
        self::COMMENT_NEW => 'comment',
        self::FORUM_TOPIC_REPLY => 'forum_topic_reply',
        self::USER_ACHIEVEMENT_UNLOCK => 'user_achievement_unlock',
    ];

    const NOTIFIABLE_CLASSES = [
        Beatmapset::class,
        Build::class,
        Channel::class,
        Topic::class,
        NewsPost::class,
        User::class,
    ];

    const SUBTYPES = [
        'comment_new' => 'comment',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public static function namesInCategory($category)
    {
        static $categories = [];

        if ($categories === []) {
            foreach (static::NAME_TO_CATEGORY as $key => $value) {
                if (!array_key_exists($value, $categories)) {
                    $categories[$value] = [];
                }

                $categories[$value][] = $key;
            }
        }

        return $categories[$category] ?? [$category];
    }

    public static function nameToCategory($name)
    {
        return static::NAME_TO_CATEGORY[$name] ?? $name;
    }

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
