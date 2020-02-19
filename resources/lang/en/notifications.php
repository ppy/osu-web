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
    'none' => 'No notifications',
    'see_all' => 'see all notifications',

    'filters' => [
        '_' => 'all',
        'user' => 'profile',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'forum',
        'news_post' => 'news',
        'build' => 'builds',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap discussion',
                'beatmapset_discussion_lock' => 'Discussion on ":title" has been locked',
                'beatmapset_discussion_lock_compact' => 'Discussion was locked',
                'beatmapset_discussion_post_new' => 'New post on ":title" by :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'New post on ":title" by :username',
                'beatmapset_discussion_post_new_compact' => 'New post by :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'New post by :username',
                'beatmapset_discussion_unlock' => 'Discussion on ":title" has been unlocked',
                'beatmapset_discussion_unlock_compact' => 'Discussion was unlocked',
            ],

            'beatmapset_problem' => [
                '_' => 'Qualified Beatmap problem',
                'beatmapset_discussion_qualified_problem' => 'Reported by :username on ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Reported by :username on ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Reported by :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Reported by :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status changed',
                'beatmapset_disqualify' => '":title" has been disqualified',
                'beatmapset_disqualify_compact' => 'Beatmap was disqualified',
                'beatmapset_love' => '":title" was promoted to loved',
                'beatmapset_love_compact' => 'Beatmap was promoted to loved',
                'beatmapset_nominate' => '":title" has been nominated',
                'beatmapset_nominate_compact' => 'Beatmap was nominated',
                'beatmapset_qualify' => '":title" has gained enough nominations and entered the ranking queue',
                'beatmapset_qualify_compact' => 'Beatmap entered ranking queue',
                'beatmapset_rank' => '":title" has been ranked',
                'beatmapset_rank_compact' => 'Beatmap was ranked',
                'beatmapset_reset_nominations' => 'Nomination of ":title" has been reset',
                'beatmapset_reset_nominations_compact' => 'Nomination was reset',
            ],

            'comment' => [
                '_' => 'New comment',

                'comment_new' => ':username commented ":content" on ":title"',
                'comment_new_compact' => ':username commented ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'New message',
                'pm' => [
                    'channel_message' => ':username says ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'from :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Changelog',

            'comment' => [
                '_' => 'New comment',

                'comment_new' => ':username commented ":content" on ":title"',
                'comment_new_compact' => ':username commented ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'News',

            'comment' => [
                '_' => 'New comment',

                'comment_new' => ':username commented ":content" on ":title"',
                'comment_new_compact' => ':username commented ":content"',
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

        'user_achievement' => [
            '_' => 'Medals',

            'user_achievement_unlock' => [
                '_' => 'New medal',
                'user_achievement_unlock' => 'Unlocked ":title"!',
                'user_achievement_unlock_compact' => 'Unlocked ":title"!',
            ],
        ],
    ],
];
