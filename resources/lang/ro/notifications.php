<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Toate notificările citite!',
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
                '_' => 'Discuții beatmap',
                'beatmapset_discussion_lock' => 'Discuția pe ":title" a fost închisă',
                'beatmapset_discussion_lock_compact' => 'Discuția a fost închisă',
                'beatmapset_discussion_post_new' => 'Postare nouă pe ":title" de :username',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Postare nouă de :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Discuția pe ":title" a fost redeschisă',
                'beatmapset_discussion_unlock_compact' => 'Discuția a fost redeschisă',
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
                'beatmapset_disqualify' => ':title a fost descalificat',
                'beatmapset_disqualify_compact' => 'Beatmap-ul a fost descalificat',
                'beatmapset_love' => ':title a fost promovat la loved',
                'beatmapset_love_compact' => 'Beatmap-ul a fost promovat la loved',
                'beatmapset_nominate' => ':title a fost nominat',
                'beatmapset_nominate_compact' => 'Beatmap-ul a fost nominat',
                'beatmapset_qualify' => ':title a starns destule nominații si a intrat în ranking queue',
                'beatmapset_qualify_compact' => 'Beatmap-ul a intrat în ranking queue',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'Comentariu nou',

                'comment_new' => ':username a comentat ":content" la ":title"',
                'comment_new_compact' => ':username a comentat ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Conversație',

            'channel' => [
                '_' => 'Mesaj nou',
                'pm' => [
                    'channel_message' => ':username spune ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de la :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Istoric modificări',

            'comment' => [
                '_' => 'Comentariu nou',

                'comment_new' => ':username a comentat ":content" la ":title"',
                'comment_new_compact' => ':username a comentat ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Noutăți',

            'comment' => [
                '_' => 'Comentariu nou',

                'comment_new' => ':username a comentat ":content" la ":title"',
                'comment_new_compact' => ':username a comentat ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Subiect forum',

            'forum_topic_reply' => [
                '_' => '',
                'forum_topic_reply' => ':username a răspuns la ":title"',
                'forum_topic_reply_compact' => ':username a răspuns',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited mesaj necitit|:count_delimited mesaje necitite',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalii',

            'user_achievement_unlock' => [
                '_' => 'Medalie nouă',
                'user_achievement_unlock' => 'Deblocat ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
