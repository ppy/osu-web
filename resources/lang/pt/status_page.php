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
