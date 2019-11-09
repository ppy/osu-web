<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Debes iniciar sesión para editar.',
            'system_generated' => 'Una publicación generada por el sistema no se puede editar.',
            'wrong_user' => 'Debes ser el dueño de la publicación para editarla.',
        ],
    ],

    'events' => [
        'empty' => 'Nada ha sucedido... aún.',
    ],

    'index' => [
        'deleted_beatmap' => 'eliminado',
        'title' => 'Discusiones del beatmap',

        'form' => [
            '_' => 'Buscar',
            'deleted' => 'Incluir discusiones eliminadas',
            'only_unresolved' => '',
            'types' => 'Tipos de mensaje',
            'username' => 'Nombre de usuario',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Usuario',
                'overview' => 'Resumen de actividades',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Fecha de publicación',
        'deleted_at' => 'Fecha de eliminación',
        'message_type' => 'Tipo',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Ninguna de las publicaciones aborda mi asunto',
        'notice' => 'Ya hay posts cerca de :timestamp (:existing_timestamps). Por favor revísalos antes de publicar.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sesión para responder',
            'user' => 'Responder',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcado como resuelto por :user',
            'false' => 'Reabierto por :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Todos',
        'label' => 'Filtrar por usuario',
    ],
];
