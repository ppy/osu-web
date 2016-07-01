<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'title' => 'status',
        'description' => 'o que tá pegando?',
    ],

    'incidents' => [
        'title' => 'Incidentes Ativos',
        'automated' => 'automatizado',
    ],

    'online' => [
        'title' => [
            'users' => 'Jogadores Online nas últimas 24 horas',
            'score' => 'Pontuações Atingidas nas últimas 24 horas',
        ],
        'current' => 'Jogadores Online',
        'score' => 'Pontuações Atingidas por Segundo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidentes Recentes',
            'state' => [
                'resolved' => 'Resolvidos',
                'resolving' => 'Resolvendo',
                'unknown' => 'Desconhecidos',
            ],
        ],

        'uptime' => [
            'title' => 'Uptime',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'hoje',
            'week' => 'semana',
            'month' => 'mês',
            'all_time' => 'eternidade',
            'last_week' => 'semana passada',
            'weeks_ago' => ':count semana atrás|:count semanas atrás',
        ],
    ],
];
