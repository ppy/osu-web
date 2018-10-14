<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Não é possível anular o hyping.',
            'has_reply' => 'Não é possível apagar a discussão com respostas',
        ],
        'nominate' => [
            'exhausted' => 'Tu alcançaste o teu limite de nomeação por dia, por favor tenta outra vez amanhã.',
            'incorrect_state' => 'Erro ao executar essa acção, por favor recarrega a página.',
            'owner' => "Não é possível nomear o próprio beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Só quem começou um segmento de mensagens ou o proprietário do beatmap é que consegue resolver uma discussão.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Apenas o proprietário do beatmap ou nomeador/membro do grupo QAT é que pode publicar notas do mapeador.',
        ],

        'vote' => [
            'limit_exceeded' => 'Por favor espera um momento antes de lançares mais votos',
            'owner' => "Não é possível votar na própria discussão.",
            'wrong_beatmapset_state' => 'Só é possível votar em discussões com beatmaps que estão a aguardar aprovação.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Uma publicação gerada automaticamente não pode ser editada.',
            'not_owner' => 'Só o publicador é que pode editar uma publicação.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Não é permitido o acesso ao canal solicitado.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'É necessário o acesso ao canal alvo.',
                    'moderated' => 'Canal actualmente monitorizado.',
                    'not_lazer' => 'Só podes falar em #lazer de momento.',
                ],

                'not_allowed' => 'Não é possível enviar mensagem enquanto estiveres banido/restrito/silenciado.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Tu não podes mudar o teu voto depois do período de votação deste concurso ter acabado.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Somente a ultima publicação pode ser apagada.',
                'locked' => 'Não é possível eliminar uma publicação dum tópico bloqueado.',
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Só o publicador é que pode apagar a publicação.',
            ],

            'edit' => [
                'deleted' => 'Não é possível editar uma publicação eliminada.',
                'locked' => 'Esta publicação está bloqueada para edição.',
                'no_forum_access' => 'Acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Só o publicador é que pode editar a publicação.',
                'topic_locked' => 'Não é possível eliminar uma publicação dum tópico bloqueado.',
            ],

            'store' => [
                'play_more' => 'Tenta jogar o jogo antes de publicar nos fóruns, por favor! Se tiveres um problema ao jogar, por favor publica no fórum de Ajuda e Suporte.',
                'too_many_help_posts' => "Precisas de jogar mais tempo o jogo antes de criares publicações adicionais. Se ainda estiveres a ter problemas enquanto jogares o jogo, envia um email para support@ppy.sh", // FIXME: unhardcode email address.
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
