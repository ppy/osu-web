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
            'exhausted' => 'Você alcançou seu limite de nomeação do dia, tente novamente amanhã.',
        ],
        'resolve' => [
            'general_discussion' => 'Discussão Geral não pôde ser resolvida.',
            'not_owner' => 'Apenas o criador da discussão e o dono do beatmap podem resolver uma discussão.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Posts automaticamente gerados não podem ser editados.',
            'not_owner' => 'Somente o autor do post pode editar a postagem.',
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
                ],

                'not_allowed' => 'Não é possível enviar mensagens enquanto estiver proibido/restrito/silenciado.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Você não pode mudar seu voto depois que o período de votação do cuncurso ter sido encerrado',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Somente o último post pode ser excluído.',
                'locked' => 'Não é possível excluir a postagem de um tópico trancado.',
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Apenas o autor do post pode deletar o post.',
            ],

            'edit' => [
                'locked' => 'A edição deste post está bloqueada',
                'no_forum_access' => 'O accesso ao fórum solicitado é obrigatório.',
                'not_owner' => 'Apenas o autor do post pode deletar o post.',
                'topic_locked' => 'Não é possível editar posts de um tópico trancado',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Você acabou de postar. Aguarde um pouco ou edite sua última postagem',
                'locked' => 'Não é possível responder a uma discussão trancada.',
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'no_permission' => 'Sem permissão para responder.',

                'user' => [
                    'require_login' => 'Por favor, faça o login para responder.',
                    'restricted' => "Não é possível responder enquanto estiver restrito.",
                    'silenced' => "Não é possível responder enquanto estiver silenciado.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
                'no_permission' => 'Sem permissão para criar novo tópico.',
                'forum_closed' => 'O fórum está trancado e também não pode ser postado.',
            ],

            'vote' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório',
                'over' => 'A votação está encerrada e não pode mais ser votada.',
                'voted' => 'Mudar o voto não é permitido.',

                'user' => [
                    'require_login' => 'Por favor, faça o login para votar.',
                    'restricted' => "Não é possível votar enquanto estiver restrito.",
                    'silenced' => "Não é possível votar enquanto estiver silenciado.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'O acesso ao fórum solicitado é obrigatório.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Capa especificada inválida.',
                'not_owner' => 'Somente o proprietário pode editar a capa.',
            ],
        ],

        'view' => [
            'admin_only' => 'Apenas o administrador pode ver este fórum.',
        ],
    ],

    'require_login' => 'Por favor, Faça o login para continuar.',

    'unauthorized' => 'Acesso negado.',

    'silenced' => 'Não pode fazer isso enquanto estiver silenciado.',

    'restricted' => 'Não é possível fazer isso enquanto estiver restrito.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'A página do usuário está trancada.',
                'not_owner' => 'Só é possível editar a própria página de usuário.',
                'require_supporter_tag' => 'Supporter tag é necessária.',
            ],
        ],
    ],
];
