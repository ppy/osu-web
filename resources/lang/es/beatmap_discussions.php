<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'No se encontraron discusiones que coincidieran con ese criterio de búsqueda.',
        'title' => 'Discusiones del mapa',

        'form' => [
            '_' => 'Buscar',
            'deleted' => 'Incluir discusiones eliminadas',
            'mode' => 'Modo del mapa',
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
        'notice' => 'Ya hay publicaciones cerca de :timestamp (:existing_timestamps). Por favor revíselas antes de publicar.',
        'unsaved' => ':count en esta revisión',
    ],

    'owner_editor' => [
        'button' => 'Dueño de la dificultad',
        'reset_confirm' => '¿Restablecer dueño para esta dificultad?',
        'user' => 'Dueño',
        'version' => 'Dificultad',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sesión para responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max bloques usados',
        'go_to_parent' => 'Ver publicación de revisión',
        'go_to_child' => 'Ver discusión',
        'validation' => [
            'block_too_large' => 'cada bloque sólo puede contener hasta :limit caracteres',
            'external_references' => 'la revisión contiene referencias a problemas que no pertenecen a esta revisión',
            'invalid_block_type' => 'tipo de bloque no válido',
            'invalid_document' => 'revisión no válida',
            'minimum_issues' => 'la revisión debe contener un mínimo de :count problema|la revisión debe contener un mínimo de :count problemas',
            'missing_text' => 'le falta texto al bloque',
            'too_many_blocks' => 'las revisiones sólo pueden contener :count párrafo/problema|las revisiones sólo pueden contener hasta :count párrafos/problemas',
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
