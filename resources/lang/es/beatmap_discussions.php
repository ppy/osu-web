<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
            'only_unresolved' => 'Mostrar sólo discusiones no resueltas',
            'types' => 'Tipos de mensaje',
            'username' => 'Nombre de usuario',

            'beatmapset_status' => [
                '_' => 'Estado del mapa',
                'all' => 'Todo',
                'disqualified' => 'Descalificado',
                'never_qualified' => 'No calificado',
                'qualified' => 'Calificado',
                'ranked' => 'Clasificado',
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
        'permalink' => 'Enlace permanente',
    ],

    'nearby_posts' => [
        'confirm' => 'Ninguna de las publicaciones aborda mi asunto',
        'notice' => 'Hay publicaciones cerca de la :timestamp (:existing_timestamps). Por favor revíselas antes de publicar.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sesión para responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Ver post de la reseña',
        'go_to_child' => 'Ver discusión',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcado como resuelto por :user',
            'false' => 'Reabierto por :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'general',
        'general_all' => 'general (todo)',
    ],

    'user_filter' => [
        'everyone' => 'Todos',
        'label' => 'Filtrar por usuario',
    ],
];
