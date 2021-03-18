<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Que tal jogar um pouco de osu! em vez disso?',
    'require_login' => 'Por favor, inicie a sessão para continuar.',
    'require_verification' => 'Por favor verifique para prosseguir.',
    'restricted' => "Não é possível fazer isso enquanto restrito.",
    'silenced' => "Não é possível fazer isso enquanto silenciado.",
    'unauthorized' => 'Acesso negado.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Não é possível desfazer o hype.',
            'has_reply' => 'Não é possível excluir uma discussão com respostas',
        ],
        'nominate' => [
            'exhausted' => 'Você atingiu o limite de nomeações diárias, tente novamente amanhã.',
            'incorrect_state' => 'Erro ao realizar esta ação, tente atualizar a página.',
            'owner' => "Não é possível nomear o próprio beatmap.",
            'set_metadata' => 'Você deve definir o gênero e o idioma antes de nomear.',
        ],
        'resolve' => [
            'not_owner' => 'Somente o autor da discussão e o dono do beatmap podem resolver uma discussão.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Apenas o criador do beatmap ou nominator/membros QAT podem publicar notas do mapeador.',
        ],

        'vote' => [
            'bot' => "Não é possível votar na discussão feita pelo bot",
            'limit_exceeded' => 'Por favor, espere um pouco antes de votar mais vezes',
            'owner' => "Não é possível votar na própria discussão.",
            'wrong_beatmapset_state' => 'Só é possível votar nas discussões de beatmaps pendentes.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Você só pode excluir suas próprias publicações.',
            'resolved' => 'Você não pode excluir a publicação de uma discussão resolvida.',
            'system_generated' => 'Publicações geradas automaticamente não podem ser excluídas.',
        ],

        'edit' => [
            'not_owner' => 'Somente o autor pode editar a publicação.',
            'resolved' => 'Você não pode editar a publicação de uma discussão resolvida.',
            'system_generated' => 'Publicações geradas automaticamente não podem ser editadas.',
        ],

        'store' => [
            'beatmapset_locked' => 'Este beatmap está bloqueado para discussão.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Você não pode alterar os metadados de um mapa nomeado. Entre em contato com um membro do BN ou NAT se você acha que ele está definido incorretamente.',
        ],
    ],

    'chat' => [
        'blocked' => 'Não é possível enviar uma mensagem para um usuário que foi bloqueado ou te bloqueou.',
        'friends_only' => 'O usuário está bloqueando mensagens de pessoas fora de sua lista de amigos.',
        'moderated' => 'O canal atual está sendo moderado.',
        'no_access' => 'Você não tem acesso a esse canal.',
        'restricted' => 'Você não pode enviar mensagens enquanto silenciado, restrito ou banido.',
        'silenced' => 'Você não pode enviar mensagens enquanto silenciado, restrito ou banido.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Não é possível editar publicações deletadas.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Não é possível alterar o voto após o fim do período de votação.',

        'entry' => [
            'limit_reached' => 'Você atingiu o limite de inscrições para este concurso',
            'over' => 'Agradecemos a sua participação! As inscrições para este concurso foram encerradas e a votação abrirá em breve.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Sem permissão para moderar este fórum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Somente a última publicação pode ser excluída.',
                'locked' => 'Não é possível excluir a publicação de um tópico trancado.',
                'no_forum_access' => 'O acesso ao fórum solicitado é necessário.',
                'not_owner' => 'Somente o autor pode excluir a publicação.',
            ],

            'edit' => [
                'deleted' => 'Não é possível editar uma publicação excluída.',
                'locked' => 'A edição desta publicação está bloqueada.',
                'no_forum_access' => 'O acesso ao fórum solicitado é necessário.',
                'not_owner' => 'Somente o autor da publicação pode editar a publicação.',
                'topic_locked' => 'Não é possível editar publicações de um tópico trancado.',
            ],

            'store' => [
                'play_more' => 'Por favor tente jogar antes de postar nos fóruns! Se você tiver algum problema com o jogo, por favor poste no fórum de Suporte e Ajuda.',
                'too_many_help_posts' => "Você precisa jogar mais antes que você possa criar postagens adicionais. Se você ainda estiver tendo problemas com o jogo, envie um email para support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Por favor, edite sua última publicação em vez de publicar novamente.',
                'locked' => 'Não é possível responder a uma discussão trancada.',
                'no_forum_access' => 'O acesso ao fórum solicitado é necessário.',
                'no_permission' => 'Sem permissão para responder.',

                'user' => [
                    'require_login' => 'Por favor, inicie a sessão para responder.',
                    'restricted' => "Não é possível responder enquanto restrito.",
                    'silenced' => "Não é possível responder enquanto silenciado.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é necessário.',
                'no_permission' => 'Sem permissão para criar um novo tópico.',
                'forum_closed' => 'O fórum está trancado e não pode ser publicado.',
            ],

            'vote' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é necessário.',
                'over' => 'A votação está encerrada e não é mais possível votar.',
                'play_more' => 'Você precisa jogar mais antes de votar no fórum.',
                'voted' => 'Não é permitido alterar o voto.',

                'user' => [
                    'require_login' => 'Por favor, inicie a sessão para votar.',
                    'restricted' => "Não é possível votar enquanto restrito.",
                    'silenced' => "Não é possível votar enquanto silenciado.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é necessário.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Capa especificada inválida.',
                'not_owner' => 'Somente o dono pode editar a capa.',
            ],
            'store' => [
                'forum_not_allowed' => 'Este fórum não aceita capas de tópicos.',
            ],
        ],

        'view' => [
            'admin_only' => 'Apenas administradores podem visualizar este fórum.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'A página do usuário está trancada.',
                'not_owner' => 'Só é possível editar sua própria página de usuário.',
                'require_supporter_tag' => 'É necessário possuir uma osu!supporter tag.',
            ],
        ],
    ],
];
