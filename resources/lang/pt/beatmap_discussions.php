<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Tens que ter sessão iniciada para editar.',
            'system_generated' => 'Uma publicação gerada pelo sistema não pode ser editada.',
            'wrong_user' => 'Tens que ser dono da publicação para editar.',
        ],
    ],

    'events' => [
        'empty' => 'Nada aconteceu... por enquanto.',
    ],

    'index' => [
        'deleted_beatmap' => 'apagado',
        'title' => 'Discussões do Beatmap',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões eliminadas',
            'only_unresolved' => '',
            'types' => 'Tipos de mensagem',
            'username' => 'Nome de utilizador',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Utilizador',
                'overview' => 'Visão geral de actividades',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data da publicação',
        'deleted_at' => 'Data de eliminação',
        'message_type' => 'Tipo',
        'permalink' => 'Link Permanente',
    ],

    'nearby_posts' => [
        'confirm' => 'Nenhuma das publicações abordam a minha preocupação',
        'notice' => 'Há publicações à volta de :timestamp (:existing_timestamps). Por favor, consulta-as antes de publicar.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sessão para Responder',
            'user' => 'Responder',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcado como resolvida por :user',
            'false' => 'Reaberta por :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Toda a gente',
        'label' => 'Filtrar por utilizador',
    ],
];
