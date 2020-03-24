<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'estado',
        'description' => '¿qué está pasando, viejo?',
    ],

    'incidents' => [
        'title' => 'Incidentes activos',
        'automated' => 'automatizado',
    ],

    'online' => [
        'title' => [
            'users' => 'Usuarios en línea en las últimas 24 Horas',
            'score' => 'Envíos de puntuaciones en las últimas 24 horas',
        ],
        'current' => 'Usuarios en línea actualmente',
        'score' => 'Envíos de puntuaciones por segundo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidentes recientes',
            'state' => [
                'resolved' => 'Resuelto',
                'resolving' => 'Resolviendo',
                'unknown' => 'Desconocido',
            ],
        ],

        'uptime' => [
            'title' => 'Tiempo de actividad',
            'graphs' => [
                'server' => 'servidor',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'hoy',
            'week' => 'semana',
            'month' => 'mes',
            'all_time' => 'todo el tiempo',
            'last_week' => 'última semana',
            'weeks_ago' => 'hace :count semana|hace :count semanas',
        ],
    ],
];
