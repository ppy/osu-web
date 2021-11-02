<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Všechna oznámení přečtena!',
    'delete' => '',
    'loading' => 'Načítání nepřečtených oznámení...',
    'mark_read' => '',
    'none' => 'Žádná oznámení',
    'see_all' => 'zobrazit všechna oznámení',
    'see_channel' => 'přejít na chat',
    'verifying' => '',

    'filters' => [
        '_' => 'vše',
        'user' => 'profil',
        'beatmapset' => 'beatmapy',
        'forum_topic' => 'fórum',
        'news_post' => 'novinky',
        'build' => 'sestavení',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmapa',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Diskuze o beatmapě',
                'beatmapset_discussion_lock' => 'Diskuze ":title" byla uzamčena',
                'beatmapset_discussion_lock_compact' => 'Diskuze byla uzamčena',
                'beatmapset_discussion_post_new' => 'Nový příspěvek v ":title" od :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nový příspěvek v ":title" od :username',
                'beatmapset_discussion_post_new_compact' => 'Nový příspěvek od :username ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nový příspěvek od :username',
                'beatmapset_discussion_review_new' => '',
                'beatmapset_discussion_review_new_compact' => '',
                'beatmapset_discussion_unlock' => 'Diskuze ":title" byla odemčena',
                'beatmapset_discussion_unlock_compact' => 'Diskuze byla odemčena',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Nahlásil :username',
            ],

            'beatmapset_state' => [
                '_' => 'Stav Beatmapy se změnil',
                'beatmapset_disqualify' => '',
                'beatmapset_disqualify_compact' => 'Beatmapa byla diskvalifikována',
                'beatmapset_love' => '',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => '":title" byla nominována',
                'beatmapset_nominate_compact' => 'Beatmapa byla nominována',
                'beatmapset_qualify' => '',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => 'Nominace byla obnovena',
            ],

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => '',
                'comment_new_compact' => ':username okomentoval ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nová zpráva',
                'pm' => [
                    'channel_message' => ':username říká ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'od :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Protokol změn',

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => ':username okomentoval ":content" v ":title"',
                'comment_new_compact' => ':username okomentoval ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Novinky',

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => ':username odpověděl ":content" v ":title"',
                'comment_new_compact' => ':username okomentoval ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Téma fóra',

            'forum_topic_reply' => [
                '_' => 'Nová odpověď na fórum',
                'forum_topic_reply' => ':username odpověděl na ":title"',
                'forum_topic_reply_compact' => ':username odpověděl',
            ],
        ],

        'legacy_pm' => [
            '_' => 'SZ původního fóra',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited nepřečtená zpráva|:count_delimited nepřečtené zprávy|:count_delimited nepřečtených zpráv',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => '',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaile',

            'user_achievement_unlock' => [
                '_' => 'Nová medaile',
                'user_achievement_unlock' => 'Odemčeno ":title"\'!',
                'user_achievement_unlock_compact' => 'Odemčeno ":title"\'!',
                'user_achievement_unlock_group' => '',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Obdrželi jste novou zprávu od :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username odemkl novou medaili, ":title"!',
                'user_achievement_unlock_self' => 'Odemkli jste novou medaili, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username vytvořil nové beatmapy',
            ],
        ],
    ],
];
