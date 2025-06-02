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

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'Crear equipo',

        'form' => [
            'name_help' => 'El nombre de tu equipo. Por el momento, los nombres son permanentes.',
            'short_name_help' => 'Máximo 4 caracteres.',
            'title' => "Vamos a crear un nuevo equipo",
        ],

        'intro' => [
            'description' => "Juega con tus amigos, con los que ya tienes o con los nuevos. Actualmente no estás en un equipo. Únete a un equipo existente visitando su página de equipo o crea tu propio equipo desde esta página.",
            'title' => '¡Equipo!',
        ],
    ],

    'destroy' => [
        'ok' => 'Equipo eliminado',
    ],

    'edit' => [
        'ok' => 'Configuración guardada correctamente.',
        'title' => 'Configuración del equipo',

        'description' => [
            'label' => 'Descripción',
            'title' => 'Descripción del equipo',
        ],

        'flag' => [
            'label' => 'Bandera del equipo',
            'title' => 'Establecer bandera del equipo',
        ],

        'header' => [
            'label' => 'Imagen del encabezado',
            'title' => 'Establecer imagen del encabezado',
        ],

        'settings' => [
            'application_help' => 'Permitir o no que las personas puedan solicitar formar parte del equipo',
            'default_ruleset_help' => 'El modo de juego que se seleccionará de forma predeterminada al visitar la página del equipo',
            'flag_help' => 'Tamaño máximo de :width×:height',
            'header_help' => 'Tamaño máximo de :width×:height',
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
                'accept_confirm' => '¿Añadir a :user al equipo?',
                'created_at' => 'Solicitud realizada',
                'empty' => 'No hay solicitudes para unirse al equipo por el momento.',
                'empty_slots' => 'Espacios disponibles',
                'empty_slots_overflow' => 'Exceso de :count_delimited usuario|Exceso de :count_delimited usuarios',
                'reject_confirm' => '¿Rechazar la solicitud para unirse de :user?',
                'title' => 'Solicitudes para unirse al equipo',
            ],

            'table' => [
                'joined_at' => 'Fecha de ingreso',
                'remove' => 'Eliminar',
                'remove_confirm' => '¿Expulsar a :user del equipo?',
                'set_leader' => 'Transferir el liderazgo del equipo',
                'set_leader_confirm' => '¿Transferir el liderazgo del equipo a :user?',
                'status' => 'Estado',
                'title' => 'Miembros actuales',
            ],

            'status' => [
                'status_0' => 'Inactivo',
                'status_1' => 'Activo',
            ],
        ],

        'set_leader' => [
            'success' => ':user es ahora el líder del equipo.',
        ],
    ],

    'part' => [
        'ok' => 'Abandonar equipo ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Chat del equipo',
            'destroy' => 'Disolver equipo',
            'join' => 'Solicitar unirse',
            'join_cancel' => 'Cancelar solicitud',
            'part' => 'Abandonar equipo',
        ],

        'info' => [
            'created' => 'Formado',
        ],

        'members' => [
            'members' => 'Miembros del equipo',
            'owner' => 'Líder del equipo',
        ],

        'sections' => [
            'about' => '¡Acerca de nosotros!',
            'info' => 'Información',
            'members' => 'Miembros',
        ],

        'statistics' => [
            'rank' => 'Puesto',
            'leader' => 'Líder del equipo',
        ],
    ],

    'store' => [
        'ok' => 'Equipo creado.',
    ],
];
