<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alla aviseringar är lästa!',
    'mark_read' => 'Rensa :type',
    'none' => 'Inga aviseringar',
    'see_all' => 'visa alla aviseringar',

    'filters' => [
        '_' => 'alla',
        'user' => 'profil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'forum',
        'news_post' => 'nyheter',
        'build' => 'build',
        'channel' => 'chatt',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmapdiskussion',
                'beatmapset_discussion_lock' => 'Diskussion om ":title" har låsts',
                'beatmapset_discussion_lock_compact' => 'Diskussionen var låst',
                'beatmapset_discussion_post_new' => 'Nytt inlägg på ":title" av :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nytt inlägg på ":title" av :username',
                'beatmapset_discussion_post_new_compact' => 'Nytt inlägg på ":username" av :content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nytt inlägg av :username',
                'beatmapset_discussion_unlock' => 'Diskussion om ":title" har låsts upp',
                'beatmapset_discussion_unlock_compact' => 'Diskussionen var upplåst',
            ],

            'beatmapset_problem' => [
                '_' => 'Kvalificerade Beatmap problem',
                'beatmapset_discussion_qualified_problem' => 'Rapporterat av :username på ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Rapporterat av :username på ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Rapporterat av :username på ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Rapporterad av :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status ändrad',
                'beatmapset_disqualify' => '":title" har diskvalificerats',
                'beatmapset_disqualify_compact' => 'Beatmap diskvalificerades',
                'beatmapset_love' => '":title" befordrades till älskad',
                'beatmapset_love_compact' => 'Beatmap befordrades till älskad',
                'beatmapset_nominate' => '":title" har nominerats',
                'beatmapset_nominate_compact' => 'Beatmap nominerades',
                'beatmapset_qualify' => '":title" har fått tillräckligt många nomineringar och angett rankingkön',
                'beatmapset_qualify_compact' => 'Beatmap har angett rankingkö',
                'beatmapset_rank' => '":title" har rankats',
                'beatmapset_rank_compact' => 'Beatmap rankades',
                'beatmapset_reset_nominations' => 'Nominering av ":title" har återställts',
                'beatmapset_reset_nominations_compact' => 'Nominering återställdes',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterade ":content" på ":title"',
                'comment_new_compact' => ':username kommenterade ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chatt',

            'channel' => [
                '_' => 'Nytt meddelande',
                'pm' => [
                    'channel_message' => ':username säger ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'från :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Ändringslogg',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterade ":content" på ":title"',
                'comment_new_compact' => ':username kommenterade ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheter',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterade ":content" på ":title"',
                'comment_new_compact' => ':username kommenterade ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forumämnen',

            'forum_topic_reply' => [
                '_' => 'Nytt forumsvar',
                'forum_topic_reply' => ':username svarade på ":title"',
                'forum_topic_reply_compact' => ':username svarade',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Forumets äldre PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited oläst meddelande|:count_delimited olästa meddelanden',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalj',
                'user_achievement_unlock' => 'Upplåst ":title"!',
                'user_achievement_unlock_compact' => 'Upplåst ":title"!',
            ],
        ],
    ],
];
