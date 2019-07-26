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
