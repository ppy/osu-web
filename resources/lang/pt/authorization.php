<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Não é possível anular o hyping.',
            'has_reply' => 'Não é possível apagar uma discussão com respostas',
        ],
        'nominate' => [
            'exhausted' => 'Tu alcançaste o teu limite de nomeações por dia, por favor tenta outra vez amanhã.',
            'full_bn_required' => 'Tu tens que ser um nomeador por completo para desempenhar esta nomeação de qualificação.',
            'full_bn_required_hybrid' => 'Tu tens que ser um nomeador por completo para nomear grupos de beatmaps com mais de um modo de jogo.',
            'incorrect_state' => 'Erro ao executar essa ação, por favor recarrega a página.',
            'owner' => "Não é possível nomear o próprio beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Só quem começou um segmento de mensagens ou o proprietário do beatmap é que consegue resolver uma discussão.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Apenas o proprietário do beatmap ou nomeador/membro do grupo QAT é que pode publicar notas de mapeador.',
        ],

        'vote' => [
            'limit_exceeded' => 'Por favor espera um momento antes de pores mais votos',
            'owner' => "Não é possível votar na própria discussão.",
            'wrong_beatmapset_state' => 'Só é possível votar em discussões com beatmaps que estejam a aguardar aprovação.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Só podes eliminar as tuas próprias publicações.',
            'resolved' => 'Não podes eliminar uma publicação duma discussão resolvida.',
            'system_generated' => 'Uma publicação automaticamente gerada não pode ser apagada.',
        ],

        'edit' => [
            'not_owner' => 'Só o publicador é que pode editar uma publicação.',
            'resolved' => 'Não podes editar uma publicação duma discussão resolvida.',
            'system_generated' => 'Uma publicação gerada automaticamente não pode ser editada.',
        ],

        'store' => [
            'beatmapset_locked' => 'Este beatmap está bloqueado para discussão.',
        ],
    ],

    'chat' => [
        'blocked' => 'Não é possível enviar uma mensagem a um utilizador que te esteja a bloquear ou que o tenhas bloqueado.',
        'friends_only' => 'O utilizador está a bloquear mensagens de pessoas que não façam parte da lista de amigos dele.',
        'moderated' => 'Esse canal está atualmente moderado.',
        'no_access' => 'Tu não tens acesso a esse canal.',
        'restricted' => 'Não podes enviar mensagens enquanto estiveres silenciado, restrito ou banido.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Não é possível editar publicações apagadas.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Tu não podes mudar o teu voto depois do período de votação deste concurso ter acabado.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Sem permissão para moderar este fórum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Somente a ultima publicação pode ser apagada.',
                'locked' => 'Não é possível eliminar uma publicação dum tópico bloqueado.',
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Só o publicador é que pode apagar a publicação.',
            ],

            'edit' => [
                'deleted' => 'Não é possível editar uma publicação eliminada.',
                'locked' => 'Esta publicação está bloqueada de ser editada.',
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Só o publicador é que pode editar a publicação.',
                'topic_locked' => 'Não é possível eliminar uma publicação dum tópico bloqueado.',
            ],

            'store' => [
                'play_more' => 'Tenta jogar o jogo antes de publicar nos fóruns, por favor! Se tiveres um problema ao jogar, por favor publica no fórum de Ajuda e Suporte.',
                'too_many_help_posts' => "Precisas de jogar mais tempo o jogo antes de criares publicações adicionais. Se ainda estiveres a ter problemas ao jogares o jogo, envia um email para support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Por favor edita a tua ultima publicação em vez de publicar novamente.',
                'locked' => 'Não é possível responder a um segmento de mensagens bloqueado.',
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'no_permission' => 'Sem permissão para responder.',

                'user' => [
                    'require_login' => 'Por favor inicia sessão para responder.',
                    'restricted' => "Não é possível responder enquanto restrito.",
                    'silenced' => "Não é possível responder enquanto silenciado.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'no_permission' => 'Sem permissão para criar novo tópico.',
                'forum_closed' => 'O fórum está fechado e não se pode publicar nele.',
            ],

            'vote' => [
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'over' => 'A sondagem acabou e não se pode votar mais nela.',
                'play_more' => 'Precisas de jogar mais antes de votar no fórum.',
                'voted' => 'A troca de voto não é permitida.',

                'user' => [
                    'require_login' => 'Por favor inicia sessão para votar.',
                    'restricted' => "Não é possível votar enquanto restrito.",
                    'silenced' => "Não é possível votar enquanto silenciado.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
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

    'require_login' => 'Por favor inicia sessão para proceder.',

    'unauthorized' => 'Acesso negado.',

    'silenced' => "Não é possível fazer isso enquanto silenciado.",

    'restricted' => "Não é possível fazer isso enquanto restrito.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'A página de utilizador está bloqueada.',
                'not_owner' => 'Só é possível editar a própria página de utilizador.',
                'require_supporter_tag' => 'Uma etiqueta de osu!supporter é necessária.',
            ],
        ],
    ],
];
