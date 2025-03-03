<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Usuario añadido al equipo.',
        ],
        'destroy' => [
            'ok' => 'Solicitud para unirse al equipo cancelada.',
        ],
        'reject' => [
            'ok' => 'Solicitud para unirse al equipo rechazada.',
        ],
        'store' => [
            'ok' => 'Solicita unirse al equipo.',
        ],
    ],

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => 'Equipo eliminado',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Configuración del equipo',

        'description' => [
            'label' => 'Descripción',
            'title' => 'Descripción del equipo',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Imagen del encabezado',
            'title' => 'Establecer imagen del encabezado',
        ],

        'settings' => [
            'application_help' => 'Permitir o no que las personas puedan solicitar formar parte del equipo',
            'default_ruleset_help' => 'El modo de juego que se seleccionará de forma predeterminada al visitar la página del equipo',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Configuración del equipo',

            'application_state' => [
                'state_0' => 'Cerradas',
                'state_1' => 'Abiertas',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'configuración',
        'leaderboard' => 'tabla de clasificación',
        'show' => 'información',

        'members' => [
            'index' => 'gestionar miembros',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Clasificación global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Miembro del equipo eliminado',
        ],

        'index' => [
            'title' => 'Gestionar miembros',

            'applications' => [
                'empty' => 'No hay solicitudes para unirse al equipo por el momento.',
                'empty_slots' => 'Espacios disponibles',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Estado',
                'joined_at' => 'Fecha de ingreso',
                'remove' => 'Eliminar',
                'title' => 'Miembros actuales',
            ],

            'status' => [
                'status_0' => 'Inactivo',
                'status_1' => 'Activo',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Formado',
        ],

        'members' => [
            'members' => 'Miembros del equipo',
            'owner' => 'Líder del equipo',
        ],

        'sections' => [
            'info' => 'Información',
            'members' => 'Miembros',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
