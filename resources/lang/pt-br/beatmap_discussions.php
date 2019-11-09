<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Precisa estar conectado para editar.',
            'system_generated' => 'Postagens geradas pelo sistema não podem ser editadas.',
            'wrong_user' => 'Precisa ser dono da postagem para editá-la.',
        ],
    ],

    'events' => [
        'empty' => 'Nada aconteceu... ainda.',
    ],

    'index' => [
        'deleted_beatmap' => 'excluído',
        'title' => 'Discussão do Beatmap',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões excluídas',
            'only_unresolved' => '',
            'types' => 'Tipos de mensagem',
            'username' => 'Nome de Usuário',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Usuário',
                'overview' => 'Supervisão de atividades',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data de publicação',
        'deleted_at' => 'Data de exclusão',
        'message_type' => 'Tipo',
        'permalink' => 'Copiar link da publicação',
    ],

    'nearby_posts' => [
        'confirm' => 'Nenhuma das postagens corresponde ao que procuro',
        'notice' => 'Existem postagens próximas de :timestamp (:existing_timestamps). Por favor, visualize-as antes de postar.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Conecte-se para Responder',
            'user' => 'Responder',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcado como resolvido por :user',
            'false' => 'Reaberto por :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Todos',
        'label' => 'Filtrar por usuário',
    ],
];
