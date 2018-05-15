<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
