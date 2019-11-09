<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'header' => [
        'title' => 'estado',
        'description' => 'como é que é meu?',
    ],

    'incidents' => [
        'title' => 'Incidentes Ativos',
        'automated' => 'automatizado',
    ],

    'online' => [
        'title' => [
            'users' => 'Utilizadores Online nas últimas 24 Horas',
            'score' => 'Submissões de Pontuação nas últimas 24 Horas',
        ],
        'current' => 'Utilizadores Online Atuais',
        'score' => 'Submissões de Pontuação por Segundo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidentes Recentes',
            'state' => [
                'resolved' => 'Solucionados',
                'resolving' => 'A Solucionar',
                'unknown' => 'Desconhecido',
            ],
        ],

        'uptime' => [
            'title' => 'Tempo Ativo',
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
