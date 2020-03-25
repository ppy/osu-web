<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Összes értesítés elolvasva!',
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
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap megbeszélés',
                'beatmapset_discussion_lock' => '":title" megbeszélése lezárult',
                'beatmapset_discussion_lock_compact' => 'A megbeszélést lezárták',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Új poszt :username által: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Új poszt :username által',
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
                '_' => 'Beatmap állapota megváltozott',
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
                '_' => 'Új hozzászólás',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Csevegés',

            'channel' => [
                '_' => 'Új üzenet',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'tőle: :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Változtatások',

            'comment' => [
                '_' => 'Új hozzászólás',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Újdonságok',

            'comment' => [
                '_' => 'Új hozzászólás',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Fórum téma',

            'forum_topic_reply' => [
                '_' => 'Új fórum válasz',
                'forum_topic_reply' => ':username válaszolt a fórum témára ":title".',
                'forum_topic_reply_compact' => ':username válaszolt',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited olvasatlan üzenet.|:count_delimited olvasatlan üzenet.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medálok',

            'user_achievement_unlock' => [
                '_' => 'Új medál',
                'user_achievement_unlock' => 'Feloldottad ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
