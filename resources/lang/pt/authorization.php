<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Que tal optar por jogar um pouco de osu! como alternativa?',
    'require_login' => 'Por favor, inicie sessão para prosseguir.',
    'require_verification' => 'Por favor, efetue a verificação para prosseguir.',
    'restricted' => "Não é possível realizar essa ação enquanto a conta estiver restrita.",
    'silenced' => "Não é possível realizar essa ação enquanto a conta estiver silenciada.",
    'unauthorized' => 'O acesso foi negado.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Não é possível anular o hype depois de aplicado.',
            'has_reply' => 'Não é possível apagar a discussão enquanto existirem respostas associadas',
        ],
        'nominate' => [
            'exhausted' => 'Atingiu o limite de nomeações diário. Por favor, tente novamente amanhã.',
            'incorrect_state' => 'Ocorreu um erro ao executar essa ação. Tente atualizar a página.',
            'owner' => "Não é possível nomear um mapa da própria autoria.",
            'set_metadata' => 'É necessário definir o género e o idioma antes de efetuar a nomeação.',
        ],
        'resolve' => [
            'not_owner' => 'Só o criador do tópico e o proprietário do mapa podem marcar uma discussão como resolvida.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Só o proprietário do mapa ou um nomeador/membro do grupo NAT está autorizado a publicar notas do criador do mapa.',
        ],

        'vote' => [
            'bot' => "Não é possível efetuar votos em discussões criadas por robôs",
            'limit_exceeded' => 'Por favor, aguarde algum tempo antes de efetuar mais votos',
            'owner' => "Não é possível efetuar votos em discussões da própria autoria.",
            'wrong_beatmapset_state' => 'A votação só está disponível em discussões de mapas que se encontrem em estado pendente.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'A eliminação está limitada às publicações da sua própria autoria.',
            'resolved' => 'Não é possível eliminar uma publicação numa discussão que já foi marcada como resolvida.',
            'system_generated' => 'Não é possível eliminar publicações geradas automaticamente.',
        ],

        'edit' => [
            'not_owner' => 'Só o autor da publicação pode editá‑la.',
            'resolved' => 'Não é possível editar uma publicação numa discussão que já foi marcada como resolvida.',
            'system_generated' => 'Não é possível editar publicações geradas automaticamente.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'A discussão deste mapa encontra‑se bloqueada.',

        'metadata' => [
            'nominated' => 'Não é possível alterar os metadados de um mapa já nomeado. Contacte um BN ou um membro do NAT caso considere que estão definidos de forma incorreta.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'É necessário ter uma pontuação registada num mapa para poder adicionar uma etiqueta.',
        ],
    ],

    'chat' => [
        'blocked' => 'Não é possível enviar mensagens a um utilizador que o esteja a bloquear ou que tenha bloqueado.',
        'friends_only' => 'O utilizador encontra‑se a bloquear mensagens provenientes de pessoas que não constam da sua lista de amigos.',
        'moderated' => 'Este canal encontra‑se atualmente moderado.',
        'no_access' => 'Não tem acesso a esse canal.',
        'no_announce' => 'Não tem permissão para publicar um anúncio.',
        'receive_friends_only' => 'O utilizador poderá não conseguir responder porque só está a aceitar mensagens de pessoas que constam da sua lista de amigos.',
        'restricted' => 'Não pode enviar mensagens enquanto estiver silenciado, restringido ou banido.',
        'silenced' => 'Não pode enviar mensagens enquanto estiver silenciado, restringido ou banido.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Os comentários estão desativados',
        ],
        'update' => [
            'deleted' => "Não é possível editar uma publicação eliminada.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'A avaliação deste concurso não se encontra ativa.',
        'voting_over' => 'Não é possível alterar o voto após o término do período de votação deste concurso.',

        'entry' => [
            'limit_reached' => 'Atingiu o limite de participações para este concurso',
            'over' => 'Obrigado pelas participações. As submissões para este concurso foram encerradas e a votação abrirá em breve.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Não tem permissão para moderar este fórum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Só é possível eliminar a última publicação.',
                'locked' => 'Não é possível eliminar uma publicação de um tópico bloqueado.',
                'no_forum_access' => 'É necessário ter acesso ao fórum solicitado.',
                'not_owner' => 'Só o autor da publicação a pode eliminar.',
            ],

            'edit' => [
                'deleted' => 'Não é possível editar uma publicação eliminada.',
                'locked' => 'A publicação está bloqueada para edição.',
                'no_forum_access' => 'É necessário ter acesso ao fórum solicitado.',
                'no_permission' => 'Não possui permissão para editar.',
                'not_owner' => 'Só o próprio criador é que pode editar a publicação.',
                'topic_locked' => 'Não é possível eliminar uma publicação dum tópico bloqueado.',
            ],

            'store' => [
                'play_more' => 'Experimente jogar o jogo antes de publicar nos fóruns, por favor. Se tiver problemas a jogar, publique no fórum de Ajuda e Suporte.',
                'too_many_help_posts' => "Precisa de jogar mais antes de poder efetuar publicações adicionais. Se continuar a ter problemas a jogar, envie um e-mail para support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Por favor, edite a sua última publicação em vez de publicar novamente.',
                'locked' => 'Não é possível responder a um tópico bloqueado.',
                'no_forum_access' => 'É necessário acesso ao fórum solicitado.',
                'no_permission' => 'Não tem permissão para responder.',

                'user' => [
                    'require_login' => 'Inicie sessão para responder.',
                    'restricted' => "Não é possível responder enquanto estiver restrito.",
                    'silenced' => "Não é possível responder enquanto estiver silenciado.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'É necessário ter acesso ao fórum solicitado.',
                'no_permission' => 'Não tem permissão para criar um tópico.',
                'forum_closed' => 'O fórum está fechado e não é possível publicar.',
            ],

            'vote' => [
                'no_forum_access' => 'É necessário ter acesso ao fórum solicitado.',
                'over' => 'A votação terminou e já não é possível votar.',
                'play_more' => 'Precisa de jogar mais antes de votar no fórum.',
                'voted' => 'A troca de voto não é permitida.',

                'user' => [
                    'require_login' => 'Inicie sessão para votar.',
                    'restricted' => "Não é possível votar enquanto estiver restrito.",
                    'silenced' => "Não é possível votar enquanto estiver silenciado.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'É necessário ter acesso ao fórum solicitado.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Capa especificada inválida.',
                'not_owner' => 'Só o proprietário é que pode editar a capa.',
            ],
            'store' => [
                'forum_not_allowed' => 'Este fórum não aceita capas de tópico.',
            ],
        ],

        'view' => [
            'admin_only' => 'Só o administrador é que pode ver este fórum.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Só o dono da sala pode fechá-la.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Não é possível afixar este tipo de pontuação",
            'failed' => "Não é possível afixar uma pontuação reprovada.",
            'not_owner' => 'Só o dono da pontuação a pode fixar.',
            'too_many' => 'Afixou demasiadas pontuações.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Já faz parte da equipa.",
                'already_other_member' => "Já faz parte de uma equipa diferente.",
                'currently_applying' => 'Tem um pedido pendente de adesão à equipa.',
                'team_closed' => 'De momento, a equipa não está a aceitar pedidos de adesão.',
                'team_full' => "A equipa está lotada e não pode aceitar mais membros.",
            ],
        ],
        'part' => [
            'is_leader' => "O líder não pode abandonar a equipa.",
            'not_member' => 'Não faz parte da equipa.',
        ],
        'store' => [
            'require_supporter_tag' => 'A etiqueta osu!supporter é necessária para criar uma equipa.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'A página de utilizador está bloqueada.',
                'not_owner' => 'Só é possível editar a própria página de utilizador.',
                'require_supporter_tag' => 'É necessária uma etiqueta osu!supporter.',
            ],
        ],
        'update_email' => [
            'locked' => 'o endereço de e-mail está bloqueado',
        ],
    ],
];
