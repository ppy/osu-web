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

return [
    'all_read' => 'All notifications read!',
    'mark_all_read' => 'Clear all',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap discussion',
                'beatmapset_discussion_lock' => '":title" has been locked for discussion',
                'beatmapset_discussion_lock_compact' => 'Locked for discussion',
                'beatmapset_discussion_post_new' => ':username posted new message in ":title"',
                'beatmapset_discussion_post_new_compact' => ':username posted new message',
                'beatmapset_discussion_unlock' => '":title" has been unlocked for discussion',
                'beatmapset_discussion_unlock_compact' => 'Unlocked for discussion',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status changed',
                'beatmapset_disqualify' => '":title" has been disqualified by :username',
                'beatmapset_disqualify_compact' => 'Disqualified by :username',
                'beatmapset_love' => '":title" has been promoted as loved by :username',
                'beatmapset_love_compact' => 'Promoted as loved by :username',
                'beatmapset_nominate' => '":title" has been nominated by :username',
                'beatmapset_nominate_compact' => 'Nominated by :username',
                'beatmapset_qualify' => '":title" has been gotten enough nominations and thus queued for ranking',
                'beatmapset_qualify_compact' => 'Queued for ranking',
                'beatmapset_reset_nominations' => 'Issue posted by :username reset nomination of ":title"',
                'beatmapset_reset_nominations_compact' => 'Issue posted by :username reset nomination',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum topic',

            'forum_topic_reply' => [
                '_' => 'New forum reply',
                'forum_topic_reply' => ':username replied to ":title"',
                'forum_topic_reply_compact' => ':username replied',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Legacy Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited unread message|:count_delimited unread messages',
            ],
        ],
    ],
];
