<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Totes les notificacions llegides!',
    'delete' => 'Eliminar :type',
    'loading' => 'Carregant notificacions sense llegir...',
    'mark_read' => 'Esborra :type ',
    'none' => 'No hi ha notificacions',
    'see_all' => 'veure totes les notificacions',
    'see_channel' => 'ves al xat',
    'verifying' => 'Verifica la sessió per a veure les notificacions',

    'action_type' => [
        '_' => 'totes',
        'beatmapset' => 'mapes',
        'build' => 'versions',
        'channel' => 'xat',
        'forum_topic' => 'fòrum',
        'news_post' => 'novetats',
        'team' => 'equip',
        'user' => 'perfil',
    ],

    'filters' => [
        '_' => 'totes',
        'beatmapset' => 'mapes',
        'build' => 'versions',
        'channel' => 'xat',
        'forum_topic' => 'fòrum',
        'news_post' => 'novetats',
        'team' => 'equip',
        'user' => 'perfil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Dificultat de convidat',
                'beatmap_owner_change' => 'Ara ets propietari de la dificultat ":beatmap" del mapa ":title"',
                'beatmap_owner_change_compact' => 'Ara ets el propietari de la dificultat ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discussió de mapes',
                'beatmapset_discussion_lock' => 'La discussió a ":title" s\'ha tancat',
                'beatmapset_discussion_lock_compact' => 'La discussió s\'ha tancat',
                'beatmapset_discussion_post_new' => 'Nova publicació a ":title" per :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nova publicació a ":title" per :username',
                'beatmapset_discussion_post_new_compact' => 'Nova publicació de :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova publicació per :username',
                'beatmapset_discussion_review_new' => 'Nova revisió de ":title" per :username que conté :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Nova revisió per :username que conté :review_counts',
                'beatmapset_discussion_unlock' => 'La discussió de ":title" s\'ha desbloquejat',
                'beatmapset_discussion_unlock_compact' => 'La discussió s\'ha desbloquejat',

                'review_count' => [
                    'praises' => ':count_delimited elogi|:count_delimited elogis',
                    'problems' => ':count_delimited problema|:count_delimited problemes',
                    'suggestions' => ':count_delimited suggeriment|:count_delimited suggeriments',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Problema amb un beatmap qualificat',
                'beatmapset_discussion_qualified_problem' => 'Informe de :username sobre ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Informe de :username sobre ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Informe de :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Informe de :username',
            ],

            'beatmapset_state' => [
                '_' => 'L\'estat del beatmap ha canviat',
                'beatmapset_disqualify' => '":title" ha estat desqualificat',
                'beatmapset_disqualify_compact' => 'El mapa ha estat desqualificat',
                'beatmapset_love' => 's\'ha promogut ":title" a "amats"',
                'beatmapset_love_compact' => 'El mapa s\'ha promocionat a "estimats"',
                'beatmapset_nominate' => '":title" ha estat nominat',
                'beatmapset_nominate_compact' => 'El mapa ha estat nominat',
                'beatmapset_qualify' => '":title" ha obtingut suficients nominacions i ha entrat a la cua per a classificatoris',
                'beatmapset_qualify_compact' => 'El mapa ha entrat a la cua per a classificatoris',
                'beatmapset_rank' => '":title" s\'ha classificat',
                'beatmapset_rank_compact' => 'El mapa s\'ha classificat',
                'beatmapset_remove_from_loved' => 's\'ha esborrat ":title" d\'"amats"',
                'beatmapset_remove_from_loved_compact' => 'El mapa s\'ha esborrat d\'"amats"',
                'beatmapset_reset_nominations' => 'La nominació de ":title" s\'ha reiniciat',
                'beatmapset_reset_nominations_compact' => 'La nominació s\'ha reiniciat',
            ],

            'comment' => [
                '_' => 'Nou comentari',

                'comment_new' => ':username ha comentat ":content" a ":title"',
                'comment_new_compact' => ':username ha comentat ":content"',
                'comment_reply' => ':username ha respost ":content" a ":title"',
                'comment_reply_compact' => ':username ha respost ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Xat',

            'announcement' => [
                '_' => 'Nou anunci',

                'announce' => [
                    'channel_announcement' => ':username diu ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Anunci de :username',
                ],
            ],

            'channel' => [
                '_' => 'Nou missatge',

                'pm' => [
                    'channel_message' => ':username diu ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de :username',
                ],
            ],

            'channel_team' => [
                '_' => '',

                'team' => [
                    'channel_team' => '',
                    'channel_team_compact' => '',
                    'channel_team_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => 'Registre de canvis',

            'comment' => [
                '_' => 'Nou comentari',

                'comment_new' => ':username ha comentat ":content" a ":title"',
                'comment_new_compact' => ':username ha comentat ":content"',
                'comment_reply' => ':username ha respost ":content" a ":title"',
                'comment_reply_compact' => ':username ha respost ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Notícies',

            'comment' => [
                '_' => 'Nou comentari',

                'comment_new' => ':username ha comentat ":content" a ":title"',
                'comment_new_compact' => ':username ha comentat ":content"',
                'comment_reply' => ':username ha respost ":content" a ":title"',
                'comment_reply_compact' => ':username ha respost ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tema del fòrum',

            'forum_topic_reply' => [
                '_' => 'Nova resposta al fòrum',
                'forum_topic_reply' => ':username ha respost a ":title"',
                'forum_topic_reply_compact' => ':username ha respost',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => '',

                'team_application_accept' => "T'has unit a l'equip :title",
                'team_application_accept_compact' => "T'has unit a l'equip :title",

                'team_application_group' => '',

                'team_application_reject' => '',
                'team_application_reject_compact' => '',
                'team_application_store' => '',
                'team_application_store_compact' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nou mapa',

                'user_beatmapset_new' => 'Nou mapa ":title" per :username',
                'user_beatmapset_new_compact' => 'Nou mapa ":title"',
                'user_beatmapset_new_group' => 'Nous mapes de :username',

                'user_beatmapset_revive' => ':username ha restaurat el beatmap «:title»',
                'user_beatmapset_revive_compact' => 'S\'ha restaurat el mapa ":title"',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalles',

            'user_achievement_unlock' => [
                '_' => 'Nova medalla',
                'user_achievement_unlock' => 'S\'ha desbloquejat ":title"!',
                'user_achievement_unlock_compact' => 'S\'ha desbloquejat ":title"!',
                'user_achievement_unlock_group' => 'S\'han desbloquejat Medalles!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Ara ets un convidat del beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'La discussió a ":title" s\'ha tancat',
                'beatmapset_discussion_post_new' => 'La discussió a ":title" té actualitzacions noves',
                'beatmapset_discussion_unlock' => 'La discussió de ":title" s\'ha obert',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'S\'ha informat d\'un nou problema a ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" ha estat desqualificat',
                'beatmapset_love' => 's\'ha promogut ":title" a "estimats"',
                'beatmapset_nominate' => '":title" ha estat nominat',
                'beatmapset_qualify' => '":title" ha obtingut suficients nominacions i ha entrat a la cua per a classificatoris',
                'beatmapset_rank' => '":title" s\'ha classificat',
                'beatmapset_remove_from_loved' => 's\'ha esborrat ":title" de "estimats"',
                'beatmapset_reset_nominations' => 'La nominació de ":title" s\'ha reiniciat',
            ],

            'comment' => [
                'comment_new' => 'El beatmap ":title" té nous comentaris',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => '',
            ],
            'channel' => [
                'channel_message' => '',
            ],
            'channel_team' => [
                'channel_team' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'El registre de canvis ":title" té nous comentaris',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Les novetats ":title" tenen nous comentaris',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Hi ha noves respostes a ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "T'has unit a l'equip :title",
                'team_application_reject' => '',
                'team_application_store' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username ha creat nous beatmaps',
                'user_beatmapset_revive' => ':username ha restaurat beatmaps',
            ],
        ],
    ],
];
