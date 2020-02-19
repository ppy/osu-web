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
                'beatmapset_discussion_lock' => 'A discussão do beatmap ":title" foi trancada.',
                'beatmapset_discussion_lock_compact' => 'A discussão foi trancada',
                'beatmapset_discussion_post_new' => ':username publicou uma nova mensagem na discussão do beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Nova publicação em ":title" de :username',
                'beatmapset_discussion_post_new_compact' => 'Nova publicação de :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova publicação de :username',
                'beatmapset_discussion_unlock' => 'A discussão do beatmap ":title" foi destrancada.',
                'beatmapset_discussion_unlock_compact' => 'A discussão foi destrancada',
            ],

            'beatmapset_problem' => [
                '_' => 'Problema do Beatmap Qualificado',
                'beatmapset_discussion_qualified_problem' => 'Reportado por :username em ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Reportado por :username em ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Reportado por :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Reportado por :username',
            ],

            'beatmapset_state' => [
                '_' => 'Estado do beatmap alterado',
                'beatmapset_disqualify' => 'O beatmap ":title" foi desqualificado por :username.',
                'beatmapset_disqualify_compact' => 'O beatmap foi desqualificado',
                'beatmapset_love' => 'O beatmap ":title" foi promovido a amado',
                'beatmapset_love_compact' => 'O beatmap foi promovido a amado',
                'beatmapset_nominate' => 'O beatmap ":title" foi nomeado por :username.',
                'beatmapset_nominate_compact' => 'O beatmap foi nomeado',
                'beatmapset_qualify' => 'O beatmap ":title" recebeu indicações suficientes e, portanto, está na fila para se tornar ranqueado.',
                'beatmapset_qualify_compact' => 'O beatmap entrou na fila para se tornar ranqueado',
                'beatmapset_rank' => '":title" se tornou ranqueado',
                'beatmapset_rank_compact' => 'O beatmap foi ranqueado',
                'beatmapset_reset_nominations' => 'Um problema publicado por :username reiniciou a nomeação do beatmap ":title" ',
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
            '_' => 'Registro de Alterações',

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
                '_' => 'Nova resposta no fórum',
                'forum_topic_reply' => ':username respondeu ao tópico ":title" do fórum.',
                'forum_topic_reply_compact' => ':username respondeu',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Mensagens Privadas do Fórum Legado',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited mensagem não lida|:count_delimited mensagens não lidas',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalhas',

            'user_achievement_unlock' => [
                '_' => 'Nova medalha',
                'user_achievement_unlock' => '":title" desbloqueado!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
