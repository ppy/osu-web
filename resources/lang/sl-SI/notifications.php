<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Vsa obvestila prebrana!',
    'delete' => 'Izbriši :type',
    'loading' => 'Nalaganje neprebranih obvestil...',
    'mark_read' => 'Počisti :type',
    'none' => 'Ni obvestil',
    'see_all' => 'prikaži vsa obvestila',
    'see_channel' => 'pojdi v klepet',
    'verifying' => 'Za ogled obvestil te prosimo za verifikacijo seje',

    'filters' => [
        '_' => 'vse',
        'user' => 'profil',
        'beatmapset' => 'beatmape',
        'forum_topic' => 'forum',
        'news_post' => 'novice',
        'build' => 'builde',
        'channel' => 'klepet',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmapa',

            'beatmap_owner_change' => [
                '_' => 'Gostiteljeva težavnost',
                'beatmap_owner_change' => 'Sedaj si lastnik težavnosti ":beatmap" beatmape ":title"',
                'beatmap_owner_change_compact' => 'Sedaj si lastnik težavnosti ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap razprava',
                'beatmapset_discussion_lock' => 'Razprava na ":title" je bila zaklenjena',
                'beatmapset_discussion_lock_compact' => 'Razprava je bila zaklenjena',
                'beatmapset_discussion_post_new' => 'Nova objava na ":title" od :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nova objava na ":title" od :username',
                'beatmapset_discussion_post_new_compact' => 'Nova objava od :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova objava od :username',
                'beatmapset_discussion_review_new' => 'Nov pregled na ":title" od :username, ki vsebuje težave: :problems, predloge: :suggestions, pohvale: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nov pregled od :username, ki vsebuje težave: :problems, predloge: :suggestions, pohvale: :praises',
                'beatmapset_discussion_unlock' => 'Razprava na ":title" je bila odklenjena',
                'beatmapset_discussion_unlock_compact' => 'Razprava je bila odklenjena',
            ],

            'beatmapset_problem' => [
                '_' => 'Težava na kvalificirani beatmapi',
                'beatmapset_discussion_qualified_problem' => 'Prijavil :username na ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Prijavil :username na ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Prijavil :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Prijavil :username',
            ],

            'beatmapset_state' => [
                '_' => 'Spremenjeno stanje beatmape',
                'beatmapset_disqualify' => '":title" je bil diskvalificiran',
                'beatmapset_disqualify_compact' => 'Beatmapa je bila diskvalificirana',
                'beatmapset_love' => '":title" je napredoval v loved',
                'beatmapset_love_compact' => 'Beatmapa je napredovala v loved',
                'beatmapset_nominate' => '":title" je bil nominiran',
                'beatmapset_nominate_compact' => 'Beatmapa je bila nominirana',
                'beatmapset_qualify' => '":title" je pridobil dovolj nominacij in se je uvrstil na čakajoči seznam za rankiranje',
                'beatmapset_qualify_compact' => 'Beatmapa se je uvrstila v čakajoči seznam za rankiranje',
                'beatmapset_rank' => '":title" je bil rankiran',
                'beatmapset_rank_compact' => 'Beatmapa je bila rankirana',
                'beatmapset_remove_from_loved' => '":title" je bil odstranjen iz Loved',
                'beatmapset_remove_from_loved_compact' => 'Beatmapa je bila odstranjena iz Loved',
                'beatmapset_reset_nominations' => 'Nominacija za ":title" se je ponastavila',
                'beatmapset_reset_nominations_compact' => 'Nominacija se je ponastavila',
            ],

            'comment' => [
                '_' => 'Nov komentar',

                'comment_new' => ':username je komentiral ":content" na ":title"',
                'comment_new_compact' => ':username je komentiral ":content"',
                'comment_reply' => ':username je odgovoril z ":content" na ":title"',
                'comment_reply_compact' => ':username je odgovoril z ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Klepet',

            'announcement' => [
                '_' => 'Nova novica',

                'announce' => [
                    'channel_announcement' => ':username pravi ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Novica od :username',
                ],
            ],

            'channel' => [
                '_' => 'Novo sporočilo',

                'pm' => [
                    'channel_message' => ':username pravi ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'od :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Dnevnik sprememb',

            'comment' => [
                '_' => 'Nov komentar',

                'comment_new' => ':username je komentiral ":content" na ":title"',
                'comment_new_compact' => ':username je komentiral ":content"',
                'comment_reply' => ':username je odgovoril z ":content" na ":title"',
                'comment_reply_compact' => ':username je odgovoril z ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Novice',

            'comment' => [
                '_' => 'Nov komentar',

                'comment_new' => ':username je komentiral ":content" na ":title"',
                'comment_new_compact' => ':username je komentiral ":content"',
                'comment_reply' => ':username je odgovoril z ":content" na ":title"',
                'comment_reply_compact' => ':username je odgovoril z ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tema foruma',

            'forum_topic_reply' => [
                '_' => 'Nov odgovor na forum',
                'forum_topic_reply' => ':username je odgovoril na ":title"',
                'forum_topic_reply_compact' => ':username je odgovoril',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited neprebrano sporočilo|:count_delimited neprebranih sporočil',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nova beatmapa',

                'user_beatmapset_new' => 'Nova beatmapa z naslovom ":title" od :username',
                'user_beatmapset_new_compact' => 'Nova beatmapa z naslovom ":title"',
                'user_beatmapset_new_group' => 'Nove beatmape od :username',

                'user_beatmapset_revive' => ':username je oživel beatmapo z naslovom ":title"',
                'user_beatmapset_revive_compact' => 'Beatmapa z naslovom ":title" je bila oživljena',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalje',

            'user_achievement_unlock' => [
                '_' => 'Nova medalja',
                'user_achievement_unlock' => '":title" odklenjeno!',
                'user_achievement_unlock_compact' => '":title" odklenjeno!',
                'user_achievement_unlock_group' => 'Odklenjene medalje!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Sedaj si gost beatmape z naslovom ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Razprava na ":title" je bila zaklenjena',
                'beatmapset_discussion_post_new' => 'Razprava na ":title" ima nove posodobitve',
                'beatmapset_discussion_unlock' => 'Razprava na ":title" je bila odklenjena',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Nova težava je bila prijavljena na ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" je bil diskvalificiran',
                'beatmapset_love' => '":title" je napredoval v loved',
                'beatmapset_nominate' => '":title" je bil nominiran',
                'beatmapset_qualify' => '":title" je pridobil dovolj nominacij in se je uvrstil na čakajoči seznam za rankiranje',
                'beatmapset_rank' => '":title" je bil rankiran',
                'beatmapset_remove_from_loved' => '":title" je bil odstranjen iz Loved',
                'beatmapset_reset_nominations' => 'Nominacija za ":title" se je ponastavila',
            ],

            'comment' => [
                'comment_new' => 'Beatmapa ":title" ima nove komentarje',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Prejel si novo sporočilo od :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Dnevnik sprememb ":title" ima nove komentarje',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Novica ":title" ima nove komentarje',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Imaš nove odgovore na ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username je odklenil novo medaljo, ":title"!',
                'user_achievement_unlock_self' => 'Odklenil si novo medaljo, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username je ustvaril nove beatmape',
                'user_beatmapset_revive' => ':username je oživel beatmape',
            ],
        ],
    ],
];
