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
        'title' => 'stato',
        'description' => 'come va amico?',
    ],

    'incidents' => [
        'title' => 'Incidenti Attivi',
        'automated' => 'automatizzato',
    ],

    'online' => [
        'title' => [
            'users' => 'Utenti Online nelle ultime 24 Ore',
            'score' => 'Punteggi Inviati nelle ultime 24 Ore',
        ],
        'current' => 'Utenti Online al Momento',
        'score' => 'Punteggi Inviati al Secondo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidenti Recenti',
            'state' => [
                'resolved' => 'Risolti',
                'resolving' => 'In Risoluzione',
                'unknown' => 'Sconosciuto',
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
            'today' => 'oggi',
            'week' => 'settimana',
            'month' => 'mese',
            'all_time' => 'tutto il tempo',
            'last_week' => 'ultima settimana',
            'weeks_ago' => ':count mese fa|:count mesi fa',
        ],
    ],
];
