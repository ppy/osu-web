<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Todas as notificações foram lidas!',
    'delete' => 'Eliminar :type',
    'loading' => 'A carregar notificações não lidas...',
    'mark_read' => 'Limpar :type',
    'none' => 'Sem notificações',
    'see_all' => 'ver todas as notificações',
    'see_channel' => 'ir para a conversa',
    'verifying' => 'Por favor verifica a sessão para ver as notificações',

    'filters' => [
        '_' => 'todas',
        'user' => 'perfil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'fórum',
        'news_post' => 'notícias',
        'build' => 'versões',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Dificuldade de convidado',
                'beatmap_owner_change' => 'És agora o dono da dificuldade ":beatmap" para o mapa ":title"',
                'beatmap_owner_change_compact' => 'És agora o dono da dificuldade ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discussão do beatmap',
                'beatmapset_discussion_lock' => 'A discussão em ":title" foi encerrada',
                'beatmapset_discussion_lock_compact' => 'A discussão foi encerrada',
                'beatmapset_discussion_post_new' => ':username publicou uma nova mensagem na discussão do beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Nova publicação em ":title" por :username',
                'beatmapset_discussion_post_new_compact' => 'Nova publicação por :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova publicação por :username',
                'beatmapset_discussion_review_new' => 'Uma nova revisão em ":title" por :username contém :problems problemas, :suggestions sugestões e :praises elogios',
                'beatmapset_discussion_review_new_compact' => 'Uma nova revisão por :username contém :problems problemas, :suggestions sugestões e :praises elogios',
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
                'beatmapset_remove_from_loved' => 'O ":title" foi removido de Adorado',
                'beatmapset_remove_from_loved_compact' => 'O beatmap foi removido de Adorado',
                'beatmapset_reset_nominations' => 'A nomeação do ":title" foi reiniciada',
                'beatmapset_reset_nominations_compact' => 'A nomeação foi reiniciada',
            ],

            'comment' => [
                '_' => 'Novo comentário',

                'comment_new' => ':username comentou ":content" em ":title"',
                'comment_new_compact' => ':username comentou ":content"',
                'comment_reply' => ':username respondeu ":content" em ":title"',
                'comment_reply_compact' => ':username respondeu ":content"',
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
                'comment_reply' => ':username respondeu ":content" em ":title"',
                'comment_reply_compact' => ':username respondeu ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Notícias',

            'comment' => [
                '_' => 'Novo comentário',

                'comment_new' => ':username comentou ":content" em ":title"',
                'comment_new_compact' => ':username comentou ":content"',
                'comment_reply' => ':username respondeu ":content" em ":title"',
                'comment_reply_compact' => ':username respondeu ":content"',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Novo beatmap',

                'user_beatmapset_new' => 'Novo beatmap ":title" por :username',
                'user_beatmapset_new_compact' => 'Novo beatmap ":title"',
                'user_beatmapset_new_group' => 'Novos beatmaps por :username',

                'user_beatmapset_revive' => 'O beatmap ":title", foi restaurado por :username',
                'user_beatmapset_revive_compact' => 'O beatmap ":title", foi restaurado',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalhas',

            'user_achievement_unlock' => [
                '_' => 'Nova medalha',
                'user_achievement_unlock' => 'Desbloqueaste ":title"!',
                'user_achievement_unlock_compact' => 'Desbloqueaste ":title"!',
                'user_achievement_unlock_group' => 'Medalhas desbloqueadas!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'És agora convidado do mapa ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'A conversa sobre ":title" foi bloqueada',
                'beatmapset_discussion_post_new' => 'A conversa sobre ":title" tem novas atualizações ',
                'beatmapset_discussion_unlock' => 'A discussão em ":title" foi desbloqueada',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Um novo problema foi relatado em ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" foi desqualificado',
                'beatmapset_love' => '":title" foi promovido a adorado',
                'beatmapset_nominate' => '":title" foi nomeado',
                'beatmapset_qualify' => 'A ":title" ganhou nomeações suficientes e entrou para a fila de classificação',
                'beatmapset_rank' => '":title" foi classificado',
                'beatmapset_remove_from_loved' => 'O ":title" foi removido de Adorado',
                'beatmapset_reset_nominations' => 'A nomeação de ":title" foi reiniciada',
            ],

            'comment' => [
                'comment_new' => 'O beatmap ":title" tem novos comentários',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Tu recebeste uma nova mensagem de :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'O registro de alterações ":title" tem novos comentários ',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'As notícias ":title" têm novos comentários',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Há novas respostas em ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username desbloqueou uma nova medalha, ":title"!',
                'user_achievement_unlock_self' => 'Desbloqueaste uma nova medalha: ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username criou novos beatmaps',
            ],
        ],
    ],
];
