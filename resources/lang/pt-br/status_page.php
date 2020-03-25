<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'estado',
        'description' => 'que que tá acontecendo, meu parsa?',
    ],

    'incidents' => [
        'title' => 'Incidentes Ativos',
        'automated' => 'automatizado',
    ],

    'online' => [
        'title' => [
            'users' => 'Usuários online nas últimas 24 Horas',
            'score' => 'Pontuações atingidas nas últimas 24 Horas',
        ],
        'current' => 'Usuários Online',
        'score' => 'Pontuações Atingidas por Segundo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidentes Recentes',
            'state' => [
                'resolved' => 'Resolvidos',
                'resolving' => 'Resolvendo',
                'unknown' => 'Desconhecido',
            ],
        ],

        'uptime' => [
            'title' => 'Tempo de Atividade',
            'graphs' => [
                'server' => 'servidor',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'hoje',
            'week' => 'semana',
            'month' => 'mês',
            'all_time' => 'desde o início',
            'last_week' => 'semana passada',
            'weeks_ago' => ':count semana atrás|:count semanas atrás',
        ],
    ],
];
