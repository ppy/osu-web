<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
