<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Sve obavijesti pročitane!',
    'delete' => 'Izbriši :type',
    'loading' => 'Učitavanje nepročitanih notifikacija...',
    'mark_read' => 'Očisti :type',
    'none' => 'Nema notifikacija',
    'see_all' => 'pogledaj sve notifikacije',
    'see_channel' => 'idi u chat',
    'verifying' => 'Molimo potvrdi sesiju za pregled obavijesti',

    'action_type' => [
        '_' => '',
        'beatmapset' => '',
        'build' => '',
        'channel' => '',
        'forum_topic' => '',
        'news_post' => '',
        'user' => '',
    ],

    'filters' => [
        '_' => 'svi',
        'user' => 'profil',
        'beatmapset' => 'beatmape',
        'forum_topic' => 'forum',
        'news_post' => 'vijesti',
        'build' => 'gradnje',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmapa',

            'beatmap_owner_change' => [
                '_' => 'Gostova težina',
                'beatmap_owner_change' => 'Sada si vlasnik/ca težine ":beatmap" za beatmapu ":title"',
                'beatmap_owner_change_compact' => 'Sada si vlasnik/ca težine ":beatmap" ',
            ],

            'beatmapset_discussion' => [
                '_' => 'Rasprava o beatmapama',
                'beatmapset_discussion_lock' => 'Rasprava na ":title" je zaključana',
                'beatmapset_discussion_lock_compact' => 'Rasprava je bila zaključana',
                'beatmapset_discussion_post_new' => 'Nova objava na ":title" od :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nova objava na ":title" od :username',
                'beatmapset_discussion_post_new_compact' => 'Nova objava od :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova objava od :username',
                'beatmapset_discussion_review_new' => 'Nova recenzija na ":title" od :username koji sardži probleme: :problems, sugestije: :suggestions, pohvale: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nova recenzija od :username koji sardži probleme: :problems, sugestije: :suggestions, pohvale: :praises',
                'beatmapset_discussion_unlock' => 'Rasprava na ":title" je upravo otključana',
                'beatmapset_discussion_unlock_compact' => 'Rasprava je bila otključana',
            ],

            'beatmapset_problem' => [
                '_' => 'Problem kvalifikovane beatmape',
                'beatmapset_discussion_qualified_problem' => 'Prijavljen od :username na ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Prijavljen od :username na ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Prijavljen od :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Prijavljen od :username',
            ],

            'beatmapset_state' => [
                '_' => 'Stanje beatmape promjenjeno',
                'beatmapset_disqualify' => '":title" je diskvalifikovan',
                'beatmapset_disqualify_compact' => 'Beatmapa je dizkvalifikovana',
                'beatmapset_love' => '":title" je unaprijeđen u loved',
                'beatmapset_love_compact' => 'Beatmapa je unaprijeđena u loved',
                'beatmapset_nominate' => '":title" je nominirana',
                'beatmapset_nominate_compact' => 'Beatmapa je nominirana',
                'beatmapset_qualify' => '":title" je setkao dovoljno nominacija i ušao u red za rangiranje',
                'beatmapset_qualify_compact' => 'Beatmapa je ušla u red za rangiranje',
                'beatmapset_rank' => '":title" je rangiran',
                'beatmapset_rank_compact' => 'Beatmapa je rangirana',
                'beatmapset_remove_from_loved' => '":title" je uklonjen iz Loved',
                'beatmapset_remove_from_loved_compact' => 'Beatmapa je uklonjena iz Loved',
                'beatmapset_reset_nominations' => 'Nominacija za ":title" su restartovane',
                'beatmapset_reset_nominations_compact' => 'Nominacija je restartovana',
            ],

            'comment' => [
                '_' => 'Novi komentar',

                'comment_new' => ':username je komentirao ":content" na ":title"',
                'comment_new_compact' => ':username je komentirao/la ":content"',
                'comment_reply' => ':username je odgovorio/la ":content" na ":title"',
                'comment_reply_compact' => ':username je odgovorio/la ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Razgovor',

            'announcement' => [
                '_' => 'Nova obavijest',

                'announce' => [
                    'channel_announcement' => ':username kaže ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Obavijest od :username',
                ],
            ],

            'channel' => [
                '_' => 'Nova poruka',

                'pm' => [
                    'channel_message' => ':username kaže ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'od :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Popis promjena',

            'comment' => [
                '_' => 'Novi komentar',

                'comment_new' => ':username je komentirao ":content" na ":title"',
                'comment_new_compact' => ':username je komentirao/la ":content"',
                'comment_reply' => ':username je odgovorio/la ":content" na ":title"',
                'comment_reply_compact' => ':username je odgovorio/la ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Vijesti',

            'comment' => [
                '_' => 'Novi komentar',

                'comment_new' => ':username je komentirao ":content" na ":title"',
                'comment_new_compact' => ':username je komentirao/la ":content"',
                'comment_reply' => ':username je odgovorio/la ":content" na ":title"',
                'comment_reply_compact' => ':username je odgovorio/la ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tema foruma',

            'forum_topic_reply' => [
                '_' => 'Novi odgovor na forumu',
                'forum_topic_reply' => ':username je odgovorio/la na ":title"',
                'forum_topic_reply_compact' => ':username je odgovorio/la',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Legacy Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited nepročitana poruka|:count_delimited nepročitane poruke',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nova beatmapa',

                'user_beatmapset_new' => 'Nova beatmapa ":title" od :username',
                'user_beatmapset_new_compact' => 'Nova beatmapa ":title"',
                'user_beatmapset_new_group' => 'Nove beatmape od :username',

                'user_beatmapset_revive' => 'Beatmapa ":title" oživljena od :username',
                'user_beatmapset_revive_compact' => 'Beatmapa ":title" oživljena',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalje',

            'user_achievement_unlock' => [
                '_' => 'Nova medalja',
                'user_achievement_unlock' => 'Otključan ":title"!',
                'user_achievement_unlock_compact' => 'Otključan ":title"!',
                'user_achievement_unlock_group' => 'Otključane medalje!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Sada si gost beatmape ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Rasprava na ":title" je zaključana',
                'beatmapset_discussion_post_new' => 'Rasprava na ":title" ima novih ažuriranja',
                'beatmapset_discussion_unlock' => 'Rasprava na ":title" je otključana',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Novi problem je prijavljen na ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" je diskvalifikovan',
                'beatmapset_love' => '":title" je unaprijeđen u loved',
                'beatmapset_nominate' => '":title" je nominiran',
                'beatmapset_qualify' => '":title" je setkao dovoljno nominacija i ušao u red za rangiranje',
                'beatmapset_rank' => '":title" je rangiran',
                'beatmapset_remove_from_loved' => '":title" je uklonjen iz Loved',
                'beatmapset_reset_nominations' => 'Nominacija za ":title" su restartovane',
            ],

            'comment' => [
                'comment_new' => 'Beatmapa ":title" ima nove komentare',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => '',
            ],

            'channel' => [
                'pm' => 'Primili ste novu poruku od :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Dnevnik promjena ":title" ima nove komentare',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Vijesti ":title" ima nove komentare',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Imaju novi odgovori u ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username je otključao novu medalju, ":title"!',
                'user_achievement_unlock_self' => 'Otključaliste novu medalju, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username jew kreirao nove beatmape',
                'user_beatmapset_revive' => ':username je oživio beatmape',
            ],
        ],
    ],
];
