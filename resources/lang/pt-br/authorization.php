<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'is_hype' => 'Não é possível desfazer o hype.',
            'has_reply' => 'Não é possível excluir uma discussão com respostas',
        ],
        'nominate' => [
            'exhausted' => 'Você atingiu o limite de nomeações diárias, tente novamente amanhã.',
        ],
        'resolve' => [
            'not_owner' => 'Somente o autor da discussão e o dono do beatmap podem resolver uma discussão.',
        ],

        'vote' => [
            'limit_exceeded' => 'Por favor, espere um pouco antes de votar mais vezes',
            'owner' => 'Não é possível votar na própria discussão!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Publicações geradas automaticamente não podem ser editadas.',
            'not_owner' => 'Somente o autor pode editar a publicação.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'O acesso ao canal solicitado não é permitido.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'O acesso ao canal solicitado é obrigatório.',
                    'moderated' => 'O canal está atualmente sob moderação.',
                    'not_lazer' => 'Você só pode conversar em #lazer no momento.',
                ],

                'not_allowed' => 'Não é possível enviar mensagens enquanto banido/restrito/silenciado.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Não é possível alterar o voto após o fim do período de votação.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Somente a última publicação pode ser excluída.',
                'locked' => 'Não é possível excluir a publicação de um tópico trancado.',
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Somente o autor pode excluir a publicação.',
            ],

            'edit' => [
                'deleted' => 'Não é possível editar uma publicação excluida.',
                'locked' => 'A edição desta publicação está bloqueada',
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Somente o autor da publicação pode editar a publicação.',
                'topic_locked' => 'Não é possível editar publicações de um tópico trancado.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Você acabou de publicar. Aguarde um pouco ou edite a sua última publicação.',
                'locked' => 'Não é possível responder a uma discussão trancada.',
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'no_permission' => 'Sem permissão para responder.',

                'user' => [
                    'require_login' => 'Por favor, inicie a sessão para responder.',
                    'restricted' => 'Não é possível responder enquanto restrito.',
                    'silenced' => 'Não é possível responder enquanto silenciado.',
                ],
            ],

            'store' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'no_permission' => 'Sem permissão para criar um novo tópico.',
                'forum_closed' => 'O fórum está trancado e não pode ser publicado.',
            ],

            'vote' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório',
                'over' => 'A votação está encerrada e não é possível mais votar.',
                'voted' => 'Não é permitido alterar o voto.',

                'user' => [
                    'require_login' => 'Por favor, inicie a sessão para votar.',
                    'restricted' => 'Não é possível votar enquanto restrito.',
                    'silenced' => 'Não é possível votar enquanto silenciado.',
                ],
            ],

            'watch' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Capa especificada inválida.',
                'not_owner' => 'Somente o dono pode editar a capa.',
            ],
        ],

        'view' => [
            'admin_only' => 'Apenas administradores podem visualizar este fórum.',
        ],
    ],

    'require_login' => 'Por favor, inicie a sessão para continuar.',

    'unauthorized' => 'Acesso negado.',

    'silenced' => 'Não é possível fazer isso enquanto silenciado.',

    'restricted' => 'Não é possível fazer isso enquanto restrito.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'A página do usuário está trancada.',
                'not_owner' => 'Só é possível editar sua própria página de usuário.',
                'require_supporter_tag' => 'Uma supporter tag é necessária.',
            ],
        ],
    ],
];
