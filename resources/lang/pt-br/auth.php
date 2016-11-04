<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'nominate' => [
            'exhausted' => 'Você atingiu o seu limite de nomeações por dia, por favor tente novamente amanhã',
        ],
        'resolve' => [
            'general_discussion' => 'Discussão Geral não pode ser resolvida.',
            'not_owner' => 'Apenas o criador do tópico e dono do beatmap pode resolver uma discussão.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Posts automaticamente gerados não podem ser editados.',
            'not_owner' => 'Apenas o autor pode editar o post.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Acesso ao canal não permitido.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Acesso ao canal é necessário.',
                    'moderated' => 'Canal atualmente moderado.',
                ],

                'not_allowed' => 'Não é possível mandar mensagens enquanto banido/restrito/silenciado.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Você não pode mudar seu voto depois do encerramento do período desta competição ter acabado.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Apenas o último post pode ser deletado.',
                'locked' => 'Não é possível deletar posts de um tópico trancado.',
                'no_forum_access' => 'Acesso ao fórum é necessário.',
                'not_owner' => 'Apenas o autor pode deletar o post.',
            ],

            'edit' => [
                'locked' => 'A edição deste post está bloqueada.',
                'no_forum_access' => 'Acesso ao fórum é necessário.',
                'not_owner' => 'Apenas o autor pode editar o post.',
                'topic_locked' => 'Não é possível editar posts de um tópico trancado.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Você acabou de postar. Espere um pouco ou edite seu último post.',
                'locked' => 'Não é possível responder a um tópico trancado.',
                'no_forum_access' => 'Acesso ao fórum é necessário.',
                'no_permission' => 'Sem permissão para responder.',

                'user' => [
                    'require_login' => 'Faça o login para responder.',
                    'restricted' => 'Não é possível responder enquanto restrito.',
                    'silenced' => 'Não é possível rsponder enquanto silenciado',
                ],
            ],

            'store' => [
                'no_forum_access' => 'Acesso ao fórum é necessário.',
                'no_permission' => 'Sem permissão para criar um novo tópico.',
                'forum_closed' => 'Este fórum está trancado e não pode ser respondido.',
            ],

            'vote' => [
                'no_forum_access' => 'Acesso ao fórum solicitado é necessário.',
                'over' => 'A votação foi encerrada e não pode receber mais votos',
                'voted' => 'Mudar o voto não é permitido.',

                'user' => [
                    'require_login' => 'Faça o login para votar.',
                    'restricted' => 'Não é possível votar enquanto restrito.',
                    'silenced' => 'Não é possível votar enquanto silenciado.',
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Access to requested forum is required.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Capa inválida.',
                'not_owner' => 'Apenas o dono pode editar a capa.',
            ],
        ],

        'view' => [
            'admin_only' => 'Apenas admins podem visualizar este fórum.',
        ],
    ],

    'require_login' => 'Logue-se para continuar.',

    'unauthorized' => 'Acesso negado.',

    'silenced' => 'Não é possível fazer isto enquanto silenciado.',

    'restricted' => 'Não é possível fazer isto enquanto restrito.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Página de usuário trancada.',
                'not_owner' => 'Só é possível editar sua própria página.',
                'require_supporter_tag' => 'Uma Supporter tag é necessária.',
            ],
        ],
    ],
];
