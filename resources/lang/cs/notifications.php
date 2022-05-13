<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Všechna oznámení přečtena!',
    'delete' => 'Odstranit :type',
    'loading' => 'Načítání nepřečtených oznámení...',
    'mark_read' => 'Vymazat :type',
    'none' => 'Žádná oznámení',
    'see_all' => 'zobrazit všechna oznámení',
    'see_channel' => 'přejít na chat',
    'verifying' => 'Prosím ověřte relaci pro zobrazení oznámení',

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
                '_' => 'Obtížnost hosta',
                'beatmap_owner_change' => 'Nyní jsi vlastníkem obtížnosti ":beatmap" pro beatmapu ":title"',
                'beatmap_owner_change_compact' => 'Nyní jsi vlastníkem obtížnosti ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Diskuze o beatmapě',
                'beatmapset_discussion_lock' => 'Diskuze ":title" byla uzamčena',
                'beatmapset_discussion_lock_compact' => 'Diskuze byla uzamčena',
                'beatmapset_discussion_post_new' => 'Nový příspěvek v ":title" od :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nový příspěvek v ":title" od :username',
                'beatmapset_discussion_post_new_compact' => 'Nový příspěvek od :username ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nový příspěvek od :username',
                'beatmapset_discussion_review_new' => 'Nová recenze na ":title" od :username obsahující problémy: :problems, návrhy: :suggestions, ocenění: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nová recenze od :username obsahující problémy: :problems, návrhy: :suggestions, ocenění: :praises',
                'beatmapset_discussion_unlock' => 'Diskuze ":title" byla odemčena',
                'beatmapset_discussion_unlock_compact' => 'Diskuze byla odemčena',
            ],

            'beatmapset_problem' => [
                '_' => 'Problém s kavlifikovanou Beatmapou',
                'beatmapset_discussion_qualified_problem' => 'Nahlášeno uživatelem :username na ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Nahlášeno uživatelem :username na ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Nahlášeno uživatelem :username ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Nahlásil :username',
            ],

            'beatmapset_state' => [
                '_' => 'Stav Beatmapy se změnil',
                'beatmapset_disqualify' => '":title" byla diskvalifikována',
                'beatmapset_disqualify_compact' => 'Beatmapa byla diskvalifikována',
                'beatmapset_love' => '":title" byla povýšena do milované kategorie',
                'beatmapset_love_compact' => 'Beatmapa byla povýšena do milované kategorie',
                'beatmapset_nominate' => '":title" byla nominována',
                'beatmapset_nominate_compact' => 'Beatmapa byla nominována',
                'beatmapset_qualify' => '":title" získala dostatek nominací a vstoupila do fronty hodnocení',
                'beatmapset_qualify_compact' => 'Beatmapa zadána do fronty hodnocení',
                'beatmapset_rank' => '":title" byla hodnocena',
                'beatmapset_rank_compact' => 'Beatmapa byla hodnocena',
                'beatmapset_remove_from_loved' => '":title" byla odstraněna z milované kategorie',
                'beatmapset_remove_from_loved_compact' => 'Beatmapa byla odstraněna z milované kategorie',
                'beatmapset_reset_nominations' => 'Nominace ":title" byla obnovena',
                'beatmapset_reset_nominations_compact' => 'Nominace byla obnovena',
            ],

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => ':username okomentoval ":content" v ":title"',
                'comment_new_compact' => ':username okomentoval ":content"',
                'comment_reply' => ':username odpověděl ":content" v ":title"',
                'comment_reply_compact' => ':username odpověděl ":content"',
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

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
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
                'beatmapset_rank' => '":title" byla hodnocena',
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
