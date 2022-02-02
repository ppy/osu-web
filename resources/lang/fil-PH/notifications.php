<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Nabasa na ang lahat ng abiso!',
    'delete' => 'Alisin :type',
    'loading' => 'Nagloload ang mga hindi pa nababasang notification...',
    'mark_read' => 'I-clear ang :type',
    'none' => 'Walang notipikasyon',
    'see_all' => 'lahat ng notipikasyon',
    'see_channel' => 'pumunta sa chat',
    'verifying' => 'I-verify ang iyong session upang makita ang mga notipikasyon',

    'filters' => [
        '_' => 'lahat',
        'user' => 'profile',
        'beatmapset' => 'mga beatmap',
        'forum_topic' => 'forum',
        'news_post' => 'mga balita',
        'build' => 'mga build',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Difficulty na gawa ng ibang manlalaro',
                'beatmap_owner_change' => 'Ikaw na ngayon ang may-ari ng difficulty na ":beatmap" para sa ":title"',
                'beatmap_owner_change_compact' => 'Ikaw na ang may-ari ng difficulty na :beatmap',
            ],

            'beatmapset_discussion' => [
                '_' => 'Talakayan ng Beatmap',
                'beatmapset_discussion_lock' => 'Ang talakayan sa ":title" ay naka-lock',
                'beatmapset_discussion_lock_compact' => 'Ang talakayan ay naka-lock',
                'beatmapset_discussion_post_new' => 'Bagong post sa ":title" ni :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Bagong post sa ":title" ni :username',
                'beatmapset_discussion_post_new_compact' => 'Bagong post ni :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Bagong post ni :username',
                'beatmapset_discussion_review_new' => 'Bagong review sa ":title" ni :username na may mga problema: :problems, mga mungkahi: :suggestions, mga papuri: :praises',
                'beatmapset_discussion_review_new_compact' => 'Bagong review ni :username na may mga problema: :problems, mga mungkahi: :suggestions, mga papuri: :praises',
                'beatmapset_discussion_unlock' => 'Ang talakayan sa ":title" ay naka-unlock',
                'beatmapset_discussion_unlock_compact' => 'Ang talakayan ay naka-unlock',
            ],

            'beatmapset_problem' => [
                '_' => 'Problema sa Kwalipikadong Beatmap',
                'beatmapset_discussion_qualified_problem' => 'Ini-ulat ni :username sa ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Ini-ulat ni :username sa ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Ini-ulat ni :username : ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Ni-report ni :username',
            ],

            'beatmapset_state' => [
                '_' => 'Nagbago ang kalagayan ng beatmap',
                'beatmapset_disqualify' => '":title" ay na-disqualify',
                'beatmapset_disqualify_compact' => 'Ang beatmap ay hindi kwalipikado',
                'beatmapset_love' => 'Ang ":title" ay na-promote sa loved',
                'beatmapset_love_compact' => 'Ang beatmap ay na-promote sa loved',
                'beatmapset_nominate' => '":title" ay na-nominate',
                'beatmapset_nominate_compact' => 'Ang beatmap ay hinirang',
                'beatmapset_qualify' => 'Ang ":title" ay nakakuha ng sapat na nominasyon at nakapasok sa ranking queue',
                'beatmapset_qualify_compact' => 'Ang beatmap ay nakapasok sa ranking queue',
                'beatmapset_rank' => 'Ang mapset ":title" ay naging ranked na',
                'beatmapset_rank_compact' => 'Nai-rank ang beatmap',
                'beatmapset_remove_from_loved' => 'Ang ":title" ay tinanggal sa Loved',
                'beatmapset_remove_from_loved_compact' => 'Ang beatmap ay tinanggal sa Loved',
                'beatmapset_reset_nominations' => 'Na-reset ang nominasyon ng ":title"',
                'beatmapset_reset_nominations_compact' => 'Na-reset ang nominasyon',
            ],

            'comment' => [
                '_' => 'Bagong comment',

                'comment_new' => '":content", komento ni :username sa ":title"',
                'comment_new_compact' => '":content", komento ni :username',
                'comment_reply' => '":content", tugon ni :username sa ":title"',
                'comment_reply_compact' => '":content", tugon ni :username',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'announcement' => [
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => '',
                    'channel_announcement_group' => '',
                ],
            ],

            'channel' => [
                '_' => 'Bagong mensahe',

                'pm' => [
                    'channel_message' => '":title", sabi ni :username',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'mula kay :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Mga Pagbabago',

            'comment' => [
                '_' => 'Bagong comment',

                'comment_new' => '":content", komento ni :username sa ":title"',
                'comment_new_compact' => '":content", komento ni :username',
                'comment_reply' => '":content", tugon ni :username sa ":title"',
                'comment_reply_compact' => '":content", tugon ni :username',
            ],
        ],

        'news_post' => [
            '_' => 'Balita',

            'comment' => [
                '_' => 'Bagong komento',

                'comment_new' => '":content", komento ni :username sa ":title"',
                'comment_new_compact' => '":content", komento ni :username',
                'comment_reply' => '":content", tugon ni :username sa ":title"',
                'comment_reply_compact' => '":content", tugon ni :username',
            ],
        ],

        'forum_topic' => [
            '_' => 'Paksa ng forum',

            'forum_topic_reply' => [
                '_' => 'Bagong reply sa forum',
                'forum_topic_reply' => 'Tumugon si :username sa ":title"',
                'forum_topic_reply_compact' => 'Tumugon si :username',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Lumang Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited na hindi pa nabasang mensahe|:count_delimited na hindi pa nabasang mga mensahe',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Bagong beatmap',

                'user_beatmapset_new' => 'Bagong beatmap ":title" ni :username',
                'user_beatmapset_new_compact' => 'Bagong beatmap ":title"',
                'user_beatmapset_new_group' => 'Mga bagong beatmap ni :username',

                'user_beatmapset_revive' => 'Beatmap ":title" ay binuhay ni :username',
                'user_beatmapset_revive_compact' => 'Beatmap ":title" ay binuhay',
            ],
        ],

        'user_achievement' => [
            '_' => 'Mga Medalya',

            'user_achievement_unlock' => [
                '_' => 'Bagong medalya',
                'user_achievement_unlock' => 'Nakamit ang ":title"!',
                'user_achievement_unlock_compact' => 'Nakamit ang ":title"!',
                'user_achievement_unlock_group' => 'Mga medalyang na-unlock!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Taga-ambag ka na sa beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Ang talakayan sa ":title" ay ni-lock',
                'beatmapset_discussion_post_new' => 'May bagong mga kaganapan sa talakayan sa ":title"',
                'beatmapset_discussion_unlock' => 'Ang talakayan sa ":title" ay in-unlock',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'May bagong problema na iniulat sa ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" ay nadiskwalipika',
                'beatmapset_love' => '":title" ay itinaguyod sa loved',
                'beatmapset_nominate' => '":title" ay nanomina',
                'beatmapset_qualify' => 'Ang ":title" ay nakakuha na ng sapat na nominasyon at nakapasok na sa ranking queue',
                'beatmapset_rank' => '":title" ay ranked na',
                'beatmapset_remove_from_loved' => '":title" ay inalis sa Loved',
                'beatmapset_reset_nominations' => 'Na-reset ang nominasyon ng ":title"',
            ],

            'comment' => [
                'comment_new' => 'Ang beatmap ":title" ay may mga bagong komento',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Nakatanggap ka ng bagong mensahe mula kay :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'May mga bagong komento ang changelog ":title"',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Ang balitang ":title" ay may mga bagong komento',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'May mga bagong tugon sa ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => 'Si :username ay nakakuha ng bagong medalya, ang ":title"!',
                'user_achievement_unlock_self' => 'Ikaw ay nakakuha ng bagong medalya, ang ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => 'Si :username ay gumawa ng mga bagong beatmap',
            ],
        ],
    ],
];
