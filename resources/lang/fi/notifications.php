<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Kaikki ilmoitukset luettu!',
    'mark_read' => '',
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
            '_' => 'Beatmappi',

            'beatmapset_discussion' => [
                '_' => '',
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_lock_compact' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => '',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => '',
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
                '_' => '',
                'beatmapset_disqualify' => '',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => '',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => '',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => '',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Uusi viesti',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => 'Muutosloki',

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => '',
                'comment_new_compact' => ':username kommentoi ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Uutiset',

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => '',
                'comment_new_compact' => ':username kommentoi":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Foorumin aihe',

            'forum_topic_reply' => [
                '_' => 'Uusi foorumi vastaus',
                'forum_topic_reply' => ':username vastasi foorumi aiheeseen ":title".',
                'forum_topic_reply_compact' => ':username vastasi',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited lukematon viesti.|:count_delimited lukemattomia viestejä.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Mitalit',

            'user_achievement_unlock' => [
                '_' => 'Uusi mitali',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
