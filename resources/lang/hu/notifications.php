<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Összes értesítés elolvasva!',
    'delete' => ':type tisztítása',
    'loading' => '',
    'mark_read' => 'Típus törlése :type',
    'none' => 'Nincsenek értesítések',
    'see_all' => 'összes értesítés megtekintése',
    'see_channel' => 'menjen a csevegéshez',
    'verifying' => '',

    'filters' => [
        '_' => 'összes',
        'user' => 'profil',
        'beatmapset' => 'beatmapek',
        'forum_topic' => 'fórum',
        'news_post' => 'újdonságok',
        'build' => 'verziók',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap megbeszélés',
                'beatmapset_discussion_lock' => '":title" megbeszélése lezárult',
                'beatmapset_discussion_lock_compact' => 'A megbeszélést lezárták',
                'beatmapset_discussion_post_new' => 'Új poszt a ":title"-on :username:-tol ":content"',
                'beatmapset_discussion_post_new_empty' => 'Új poszt a ":title"-on :username:-tol',
                'beatmapset_discussion_post_new_compact' => 'Új poszt :username által: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Új poszt :username által',
                'beatmapset_discussion_review_new' => 'Új hozzászolás problémákat tartalmazó tartalomról :username által, ezen a beatmapen: ":title"  
:problems, javaslat :suggestions, dícséret: :praises',
                'beatmapset_discussion_review_new_compact' => 'Új hozzászolás problémákat tartalmazó tartalomról :username által: :problems, javaslat :suggestions, dícséret: :praises',
                'beatmapset_discussion_unlock' => 'A beszélgetést feloldották ezen: ":title"',
                'beatmapset_discussion_unlock_compact' => 'A beszélgetést feloldották',
            ],

            'beatmapset_problem' => [
                '_' => 'Rankedelési probléma a beatmapen',
                'beatmapset_discussion_qualified_problem' => ':username által jelentve lett itt: ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => ':username által jelentve lett itt: ":title"',
                'beatmapset_discussion_qualified_problem_compact' => ':username által jelentve lett ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username által jelentve lett',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap állapota megváltozott',
                'beatmapset_disqualify' => 'Ez a beatmap diszkvalifikálva lett: ":title"',
                'beatmapset_disqualify_compact' => 'A beatmap diszkvalifikálva lett',
                'beatmapset_love' => 'Ez a map kedvelt kategóriába lépett: ":title"',
                'beatmapset_love_compact' => 'Ez a map kedvelt kategóriába lépett',
                'beatmapset_nominate' => 'Ez a beatmap rankedelt lett: ":title"',
                'beatmapset_nominate_compact' => 'A beatmap rankedelt lett',
                'beatmapset_qualify' => '":title" elért annyi szavazatot hogy rankedelési státuszba lépett',
                'beatmapset_qualify_compact' => 'A beatmap rankolási sorba lépett',
                'beatmapset_rank' => ':title rankedelt lett',
                'beatmapset_rank_compact' => 'A beatmap rankedelt lett',
                'beatmapset_remove_from_loved' => 'Ez a map el lett távolítva a kedvelt kategóriából:title',
                'beatmapset_remove_from_loved_compact' => 'Ez a beatmap el lett távolítva a kedvelt kategóriából',
                'beatmapset_reset_nominations' => 'Rankolás elutasítva ezen: ":title"',
                'beatmapset_reset_nominations_compact' => 'Rankolás elutasítva',
            ],

            'comment' => [
                '_' => 'Új hozzászólás',

                'comment_new' => ':username ezt kommentálta: ":content" ezen: ":title"',
                'comment_new_compact' => ':username ezt kommentálta: ":content"',
                'comment_reply' => ':username ezt válaszolta: ":content" itt: ":title"',
                'comment_reply_compact' => ':username ezt válaszolta: ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Csevegés',

            'channel' => [
                '_' => 'Új üzenet',
                'pm' => [
                    'channel_message' => ':username üzeni ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'tőle: :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Változtatások',

            'comment' => [
                '_' => 'Új hozzászólás',

                'comment_new' => ':username ezt kommentálta: ":content" ezen: ":title"',
                'comment_new_compact' => ':username ezt kommentálta: ":content"',
                'comment_reply' => ':username ezt válaszolta: ":content" itt: ":title"',
                'comment_reply_compact' => ':username ezt válaszolta: ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Újdonságok',

            'comment' => [
                '_' => 'Új hozzászólás',

                'comment_new' => ':username ezt kommentálta: ":content" ezen: ":title"',
                'comment_new_compact' => ':username ezt kommentálta: ":content"',
                'comment_reply' => ':username ezt válaszolta: ":content" itt: ":title"',
                'comment_reply_compact' => ':username ezt válaszolta: ":content"',
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
            '_' => 'Hivatalos PM fórum',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited olvasatlan üzenet.|:count_delimited olvasatlan üzenet.',
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
            '_' => 'Medálok',

            'user_achievement_unlock' => [
                '_' => 'Új medál',
                'user_achievement_unlock' => 'Feloldottad ":title"!',
                'user_achievement_unlock_compact' => 'Feloldottad":title"!',
                'user_achievement_unlock_group' => 'Medálok feloldva!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'A hozzászolás le lett tiltva ezen a beamapen::title',
                'beatmapset_discussion_post_new' => 'A hozzászólás frissült a következőn: :title',
                'beatmapset_discussion_unlock' => 'A hozzászolás elérhető lett ezen a beatmapen::title',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Egy új probléma jelentve lett itt::title',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" dalt diszkvalifikálták',
                'beatmapset_love' => '":title" dalt kedvelt kategóriába került',
                'beatmapset_nominate' => 'Nominálva lett ":title"',
                'beatmapset_qualify' => '":title" elért annyi szavazatot hogy rankedelési státuszba lépett',
                'beatmapset_rank' => ':title rankedelt lett',
                'beatmapset_remove_from_loved' => 'Ez a map el lett távolítva a kedvelt kategóriából:title',
                'beatmapset_reset_nominations' => '":title" nominálása vissza lett állítva',
            ],

            'comment' => [
                'comment_new' => ' Új kommentek jelentek meg ezen a beatmapen::title',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Új üzenetet kaptál tőle::username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Új kommentek jelentek meg itt::title',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Új kommentek jelentek meg itt::title',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Új válaszok itt: ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username feloldott egy új medált! ":title"',
                'user_achievement_unlock_self' => 'Feloldottál egy új medált! ":title"',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
            ],
        ],
    ],
];
