<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'estado',
        'description' => 'como é que é, meu?',
    ],

    'incidents' => [
        'title' => 'Incidentes ativos',
        'automated' => 'automatizado',
    ],

    'online' => [
        'title' => [
            'users' => 'Utilizadores online nas últimas 24 horas',
            'score' => 'Submissões de pontuação nas últimas 24 horas',
        ],
        'current' => 'Utilizadores online atuais',
        'score' => 'Submissões de pontuação por segundo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidentes recentes',
            'state' => [
                'resolved' => 'Resolvidos',
                'resolving' => 'A resolver',
                'unknown' => 'Desconhecido',
            ],
        ],

        'uptime' => [
            'title' => 'Tempo ativo',
            'graphs' => [
                'server' => 'servidor',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'hoje',
            'week' => 'semana',
            'month' => 'mês',
            'all_time' => 'todas as alturas',
            'last_week' => 'última semana',
            'weeks_ago' => ':count semana passada|:count semanas passadas',
        ],
    ],
];
