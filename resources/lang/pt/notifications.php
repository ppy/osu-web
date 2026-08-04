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
    'verifying' => 'Por favor, verifique a sessão para ver as notificações',

    'action_type' => [
        '_' => 'tudo',
        'beatmapset' => 'mapas',
        'build' => 'compilações',
        'channel' => 'conversa',
        'forum_topic' => 'fórum',
        'news_post' => 'notícias',
        'team' => 'equipa',
        'user' => 'perfil',
    ],

    'filters' => [
        '_' => 'todas',
        'beatmapset' => 'mapas',
        'build' => 'versões',
        'channel' => 'conversa',
        'forum_topic' => 'fórum',
        'news_post' => 'notícias',
        'team' => 'equipa',
        'user' => 'perfil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Mapa',

            'beatmap_owner_change' => [
                '_' => 'Dificuldade de convidado',
                'beatmap_owner_change' => 'É agora proprietário da dificuldade ":beatmap" do mapa ":title"',
                'beatmap_owner_change_compact' => 'É agora proprietário da dificuldade ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discussão do mapa',
                'beatmapset_discussion_lock' => 'A discussão sobre ":title" foi bloqueada',
                'beatmapset_discussion_lock_compact' => 'A discussão foi bloqueada',
                'beatmapset_discussion_post_new' => 'Nova publicação em ":title" por :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nova publicação em ":title" por :username',
                'beatmapset_discussion_post_new_compact' => 'Nova publicação por :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nova publicação por :username',
                'beatmapset_discussion_review_new' => 'Nova avaliação em ":title" por :username contendo :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Nova avaliação por :username contendo :review_counts',
                'beatmapset_discussion_unlock' => 'A discussão sobre ":title" foi desbloqueada',
                'beatmapset_discussion_unlock_compact' => 'A discussão foi desbloqueada',

                'review_count' => [
                    'praises' => ':count_delimited elogio|:count_delimited elogios',
                    'problems' => ':count_delimited problema|:count_delimited problemas',
                    'suggestions' => ':count_delimited sugestão|:count_delimited sugestões',
                ],
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
                'beatmapset_love' => 'O mapa ":title" foi promovido a adorado',
                'beatmapset_love_compact' => 'O mapa foi promovido a adorado',
                'beatmapset_nominate' => 'O mapa ":title" foi nomeado',
                'beatmapset_nominate_compact' => 'O mapa foi nomeado',
                'beatmapset_qualify' => 'O mapa ":title" recebeu nomeações suficientes e entrou na fila de classificação',
                'beatmapset_qualify_compact' => 'O mapa entrou na fila de classificação',
                'beatmapset_rank' => 'O mapa ":title" foi classificado',
                'beatmapset_rank_compact' => 'O mapa foi classificado',
                'beatmapset_remove_from_loved' => 'O mapa ":title" foi removido de Adorado',
                'beatmapset_remove_from_loved_compact' => 'O mapa foi removido de Adorado',
                'beatmapset_reset_nominations' => 'A nomeação do mapa ":title" foi reiniciada',
                'beatmapset_reset_nominations_compact' => 'A nomeação do mapa foi reiniciada',
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
            '_' => 'Conversa',

            'announcement' => [
                '_' => 'Novo comunicado',

                'announce' => [
                    'channel_announcement' => ':username diz ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Comunicado de :username',
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

            'channel_mention' => [
                '_' => 'Menção na conversa',

                'public' => [
                    'channel_mention' => ':username mencionou‑o em :name ":title"',
                    'channel_mention_compact' => ':username ":title"',
                    'channel_mention_group' => 'mencionado em :name',
                ],
            ],

            'channel_team' => [
                '_' => 'Nova mensagem da equipa',

                'team' => [
                    'channel_team' => ':username diz ":title"',
                    'channel_team_compact' => ':username diz ":title"',
                    'channel_team_group' => ':username diz ":title"',
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

            'news_post' => [
                '_' => 'Notícias (:series)',

                'news_post_new' => ':title',
                'news_post_new_compact' => ':title',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tópico do fórum',

            'forum_topic_reply' => [
                '_' => 'Nova resposta do fórum',
                'forum_topic_reply' => ':username respondeu ao tópico do fórum ":title"',
                'forum_topic_reply_compact' => ':username respondeu',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Pedido de adesão à equipa',

                'team_application_accept' => "Agora pertence à equipa :title",
                'team_application_accept_compact' => "Agora pertence à equipa :title",

                'team_application_group' => 'Atualizações em pedidos de adesão à equipa',

                'team_application_reject' => 'O seu pedido de adesão à equipa :title foi recusado',
                'team_application_reject_compact' => 'O seu pedido de adesão à equipa :title foi recusado',
                'team_application_store' => ':title pediu para se juntar à sua equipa',
                'team_application_store_compact' => ':title pediu para se juntar à sua equipa',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Novo mapa',

                'user_beatmapset_new' => 'Novo mapa ":title" por :username',
                'user_beatmapset_new_compact' => 'Novo beatmap ":title"',
                'user_beatmapset_new_group' => 'Novos mapas por :username',

                'user_beatmapset_revive' => 'O mapa ":title" foi revivido por :username',
                'user_beatmapset_revive_compact' => 'O mapa ":title" foi revivido',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalhas',

            'user_achievement_unlock' => [
                '_' => 'Nova medalha',
                'user_achievement_unlock' => 'Desbloqueou ":title"!',
                'user_achievement_unlock_compact' => 'Desbloqueou ":title"!',
                'user_achievement_unlock_group' => 'Medalhas desbloqueadas!',
            ],
        ],
    ],

    'mail' => [
        'news' => 'Novidades',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'É agora convidado do mapa ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'A discussão em ":title" foi bloqueada',
                'beatmapset_discussion_post_new' => 'A discussão em ":title" tem novas atualizações ',
                'beatmapset_discussion_unlock' => 'A discussão em ":title" foi desbloqueada',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Foi reportado um novo problema em ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" foi desqualificado',
                'beatmapset_love' => '":title" foi promovido a adorado',
                'beatmapset_nominate' => '":title" foi nomeado',
                'beatmapset_qualify' => '":title" ganhou nomeações suficientes e entrou para a fila de classificação',
                'beatmapset_rank' => '":title" foi classificado',
                'beatmapset_remove_from_loved' => '":title" foi removido de Adorado',
                'beatmapset_reset_nominations' => 'A nomeação de ":title" foi reiniciada',
            ],

            'comment' => [
                'comment_new' => 'O mapa ":title" tem novos comentários',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Há um novo comunicado em ":name"',
            ],
            'channel' => [
                'channel_message' => 'Recebeu uma nova mensagem de :username',
            ],
            'channel_mention' => [
                'channel_mention' => ':username mencionou‑o em :name ":title"',
            ],

            'channel_team' => [
                'channel_team' => 'Há uma nova mensagem na equipa ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'O registo de alterações ":title" tem novos comentários',
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

        'team' => [
            'team_application' => [
                'team_application_accept' => "Agora pertence à equipa :title",
                'team_application_reject' => 'O seu pedido de adesão à equipa :title foi recusado',
                'team_application_store' => ':title pediu para se juntar à sua equipa',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username criou novos mapas',
                'user_beatmapset_revive' => ':username reviveu mapas',
            ],
        ],
    ],
];
