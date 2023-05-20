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
    'see_channel' => 'vés al xat',
    'verifying' => 'Verifica la sessió per a veure les notificacions',

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
        '_' => 'totes',
        'user' => 'perfil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'fòrum',
        'news_post' => 'novetats',
        'build' => 'versions',
        'channel' => 'xat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Dificultat de convidat',
                'beatmap_owner_change' => 'Ara ets propietari de la dificultat ":beatmap" per al beatmap ":title"',
                'beatmap_owner_change_compact' => 'Ara ets el propietari de la dificultat ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discussió de beatmaps',
                'beatmapset_discussion_lock' => 'La discussió a ":title" s\'ha tancat',
                'beatmapset_discussion_lock_compact' => 'La discussió s\'ha tancat',
                'beatmapset_discussion_post_new' => 'Nova publicació a ":title" per :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nova publicació a ":title" per :username',
                'beatmapset_discussion_post_new_compact' => 'Nova publicació de :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova publicació per :username',
                'beatmapset_discussion_review_new' => 'Nova revisió de ":title" per :username que conté problemes: :problems, suggeriments :suggestions, elogis: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nova revisió per :username que conté problemes: :problems, suggeriments :suggestions, elogis: :praises',
                'beatmapset_discussion_unlock' => 'La discussió de ":title" s\'ha obert',
                'beatmapset_discussion_unlock_compact' => 'La discussió s\'ha obert',
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
                'beatmapset_disqualify_compact' => 'El beatmap ha estat desqualificat',
                'beatmapset_love' => 's\'ha promogut ":title" a "estimats"',
                'beatmapset_love_compact' => 'El beatmap s\'ha promocionat a "estimats"',
                'beatmapset_nominate' => '":title" ha estat nominat',
                'beatmapset_nominate_compact' => 'El beatmap ha estat nominat',
                'beatmapset_qualify' => '":title" ha obtingut suficients nominacions i ha entrat a la cua per a classificatoris',
                'beatmapset_qualify_compact' => 'El beatmap ha entrat a la cua per a classificatoris',
                'beatmapset_rank' => '":title" s\'ha classificat',
                'beatmapset_rank_compact' => 'El beatmap s\'ha classificat',
                'beatmapset_remove_from_loved' => 's\'ha esborrat ":title" de "estimats"',
                'beatmapset_remove_from_loved_compact' => 'El beatmap s\'ha esborrat de "estimats"',
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

        'legacy_pm' => [
            '_' => 'MP del fòrum antic',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited missatge no llegit|:count_delimited missatges no llegits',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nou beatmap',

                'user_beatmapset_new' => 'Nou beatmap ":title" per :username',
                'user_beatmapset_new_compact' => 'Nou beatmap ":title"',
                'user_beatmapset_new_group' => 'Nous beatmaps de :username',

                'user_beatmapset_revive' => ':username ha restaurat el beatmap ":title"',
                'user_beatmapset_revive_compact' => 'S\'ha restaurat el beatmap ":title"',
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
                'announce' => 'Hi ha un nou anunci a ":name"',
            ],

            'channel' => [
                'pm' => 'Has rebut un nou missatge de :username',
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

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username ha desbloquejat una nova medalla, ":title"!',
                'user_achievement_unlock_self' => 'Has desbloquejat una nova medalla, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username ha creat nous beatmaps',
                'user_beatmapset_revive' => ':username ha restaurat beatmaps',
            ],
        ],
    ],
];
