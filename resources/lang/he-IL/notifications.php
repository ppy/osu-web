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
    'all_read' => 'כל ההתראות נקראו!',
    'mark_all_read' => 'נקה הכל',
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'מפה',

            'beatmapset_discussion' => [
                '_' => 'דיוני מפות',
                'beatmapset_discussion_lock' => 'מפה ":title" ננעלה לדיון.',
                'beatmapset_discussion_lock_compact' => '',
                'beatmapset_discussion_post_new' => ':username פרסם הודעה חדשה בדיון מפה ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => '',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'מפה ":title" נפתחה לדיון.',
                'beatmapset_discussion_unlock_compact' => '',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'סטטוס מפה השתנה',
                'beatmapset_disqualify' => 'מפה ":title" נפסלה על ידי :username.',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => 'מפה ":title" קודמה כאהובה על ידי :username.',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => 'מפה ":title" מונתה על ידי :username.',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => 'מפה ":title" קיבלה מספיק מינויים ולכן היא בתור לדירוג.',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => 'בעיה שפורסמה על י די :username איפסה את מינויה של מפה ":title" ',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => '',

            'channel' => [
                '_' => '',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => '',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'נושא פורום',

            'forum_topic_reply' => [
                '_' => 'תגובת פורום חדשה',
                'forum_topic_reply' => ':username הגיב לנושא פורום ":title".',
                'forum_topic_reply_compact' => '',
            ],
        ],

        'legacy_pm' => [
            '_' => 'הודעה פרטית ישנה',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited הודעה שלא נקראה.|:count_delimited הודעות שלא נקראו.',
            ],
        ],

        'user_achievement' => [
            '_' => '',

            'user_achievement_unlock' => [
                '_' => '',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
