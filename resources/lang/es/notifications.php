<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'all_read' => '¡Todas las notificaciones leídas!',
    'mark_all_read' => 'Borrar todo',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discusión de beatmap',
                'beatmapset_discussion_lock' => 'La discusión en ":title" se ha cerrado',
                'beatmapset_discussion_lock_compact' => 'La discusión fue cerrada',
                'beatmapset_discussion_post_new' => 'Nuevo post en ":title" por :username',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Nuevo post por :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'La discusión en ":title" se ha desbloqueado',
                'beatmapset_discussion_unlock_compact' => 'La discusión se ha desbloqueado',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Cambió el estado del Beatmap',
                'beatmapset_disqualify' => '":title" ha sido descalificado',
                'beatmapset_disqualify_compact' => 'El Beatmap fue descalificado',
                'beatmapset_love' => '":title" fue promovido a amado',
                'beatmapset_love_compact' => 'Beatmap fue promovido a amado',
                'beatmapset_nominate' => '":title" ha sido nominado',
                'beatmapset_nominate_compact' => 'Beatmap fue nominado',
                'beatmapset_qualify' => '":title" hha ganado suficientes nominaciones e ingresó a la cola de clasificación',
                'beatmapset_qualify_compact' => 'Beatmap ingresó a la cola de clasificación',
                'beatmapset_rank' => '":title" ha sido clasificado',
                'beatmapset_rank_compact' => 'Beatmap fue clasificado',
                'beatmapset_reset_nominations' => 'La nominación de ":title" ha sido reiniciada',
                'beatmapset_reset_nominations_compact' => 'La nominación fue reiniciada',
            ],

            'comment' => [
                '_' => 'Nuevo comentario',

                'comment_new' => ':username comentó ":content" en ":title"',
                'comment_new_compact' => ':username comentó ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nuevo mensaje',
                'pm' => [
                    'channel_message' => ':username dice ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Registro de cambios',

            'comment' => [
                '_' => 'Nuevo comentario',

                'comment_new' => ':username comentó ":content" en ":title"',
                'comment_new_compact' => ':username comentó ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Noticias',

            'comment' => [
                '_' => 'Nuevo comentario',

                'comment_new' => ':username comentó ":content" en ":title"',
                'comment_new_compact' => ':username comentó ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tema del foro',

            'forum_topic_reply' => [
                '_' => 'Nueva respuesta en el foro',
                'forum_topic_reply' => ':username respondió a ":title"',
                'forum_topic_reply_compact' => ':username respondió',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Legacy Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited mensaje sin leer|:count_delimited mensajes sin leer',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medallas',

            'user_achievement_unlock' => [
                '_' => 'Nueva medalla',
                'user_achievement_unlock' => '¡Desbloqueado ":title"!',
            ],
        ],
    ],
];
