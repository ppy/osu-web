<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Configuración guardada correctamente',
        'title' => 'Configuración del equipo',

        'description' => [
            'label' => 'Descripción',
            'title' => 'Descripción del equipo',
        ],

        'header' => [
            'label' => 'Imagen del encabezado',
            'title' => 'Establecer imagen del encabezado',
        ],

        'logo' => [
            'label' => 'Bandera del equipo',
            'title' => 'Establecer bandera del equipo',
        ],

        'settings' => [
            'application' => 'Solicitudes para unirse al equipo',
            'application_help' => 'Permitir o no que las personas puedan solicitar formar parte del equipo',
            'default_ruleset' => 'Modo de juego predeterminado',
            'default_ruleset_help' => 'El modo de juego que se seleccionará de forma predeterminada al visitar la página del equipo',
            'title' => 'Configuración del equipo',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Cerradas',
                'state_1' => 'Abiertas',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Miembro del equipo eliminado',
        ],

        'index' => [
            'title' => 'Gestionar miembros',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
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
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Formado',
            'website' => 'Sitio web',
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
];
