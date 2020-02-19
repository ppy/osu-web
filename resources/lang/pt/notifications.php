<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'all_read' => 'Todas as notificações foram lidas!',
    'mark_all_read' => 'Limpar tudo',
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
                '_' => 'Discussão do beatmap',
                'beatmapset_discussion_lock' => 'A discussão em ":title" foi encerrada',
                'beatmapset_discussion_lock_compact' => 'A discussão foi encerrada',
                'beatmapset_discussion_post_new' => ':username publicou uma nova mensagem na discussão do beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Nova publicação em ":title" por :username',
                'beatmapset_discussion_post_new_compact' => 'Nova publicação por :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova publicação por :username',
                'beatmapset_discussion_unlock' => 'A discussão em ":title" foi aberta',
                'beatmapset_discussion_unlock_compact' => 'A discussão foi aberta',
            ],

            'beatmapset_problem' => [
                '_' => 'Problema do beatmap qualificado',
                'beatmapset_discussion_qualified_problem' => 'Exposto por :username em ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Exposto por :username em ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Exposto por :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Exposto por :username',
            ],

            'beatmapset_state' => [
                '_' => 'Estado do beatmap alterado',
                'beatmapset_disqualify' => 'O beatmap ":title" foi desqualificado',
                'beatmapset_disqualify_compact' => 'O beatmap foi desqualificado',
                'beatmapset_love' => 'O beatmap ":title" foi promovido a adorado',
                'beatmapset_love_compact' => 'O beatmap foi promovido a adorado',
                'beatmapset_nominate' => 'O beatmap ":title" foi nomeado',
                'beatmapset_nominate_compact' => 'O beatmap foi nomeado',
                'beatmapset_qualify' => 'O beatmap ":title" obteve nomeações suficiente e portanto, entrou na fila para ser classificado.',
                'beatmapset_qualify_compact' => 'O beatmap entrou na fila para se classificar',
                'beatmapset_rank' => 'O beatmap ":title" foi classificado',
                'beatmapset_rank_compact' => 'O beatmap foi classificado',
                'beatmapset_reset_nominations' => 'A nomeação do ":title" foi reiniciada',
                'beatmapset_reset_nominations_compact' => 'A nomeação foi reiniciada',
            ],

            'comment' => [
                '_' => 'Novo comentário',

                'comment_new' => ':username comentou ":content" em ":title"',
                'comment_new_compact' => ':username comentou ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nova mensagem',
                'pm' => [
                    'channel_message' => ':username diz ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Registo de alterações',

            'comment' => [
                '_' => 'Novo comentário',

                'comment_new' => ':username comentou ":content" em ":title"',
                'comment_new_compact' => ':username comentou ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Notícias',

            'comment' => [
                '_' => 'Novo comentário',

                'comment_new' => ':username comentou ":content" em ":title"',
                'comment_new_compact' => ':username comentou ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tópico do fórum',

            'forum_topic_reply' => [
                '_' => 'Nova resposta do fórum',
                'forum_topic_reply' => ':username respondeu ao tópico do fórum ":title".',
                'forum_topic_reply_compact' => ':username respondeu',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Fórum de legado de mensagens privadas',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited mensagem não lida.|:count_delimited mensagens não lidas',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalhas',

            'user_achievement_unlock' => [
                '_' => 'Nova medalha',
                'user_achievement_unlock' => 'Desbloqueaste ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
