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
        'description' => 'o que tá acontecendo?'
    ],
    'incidents' => [
        'title' => 'Incidentes ativos',
        'automated' => 'automatizado'
    ],
    'online' => [
        'title' => [
            'users' => 'Jogadores online nas últimas 24 horas',
            'score' => 'Pontuações atingidas nas últimas 24 horas'
        ],
        'current' => 'Jogadores online',
        'score' => 'Pontuações atingidas por segundo'
    ],
    'recent' => [
        'incidents' => [
            'title' => 'Incidentes recentes',
            'state' => [
                'resolved' => 'Resolvidos',
                'resolving' => 'Resolvendo',
                'unknown' => 'Desconhecidos'
            ]
        ],
        'uptime' => [
            'title' => 'Tempo de atividade',
            'graphs' => [
                'server' => 'servidor',
                'web' => 'web'
            ]
        ],
        'when' => [
            'today' => 'hoje',
            'week' => 'semana',
            'month' => 'mês',
            'all_time' => 'desde o início',
            'last_week' => 'semana passada',
            'weeks_ago' => ':count semana atrás|:count semanas atrás'
        ]
    ]
];
