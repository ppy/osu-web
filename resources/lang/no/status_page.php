<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'hva skjer min fyr?',
    ],

    'incidents' => [
        'title' => 'Aktive Hendelser',
        'automated' => 'automatisert',
    ],

    'online' => [
        'title' => [
            'users' => 'Påloggede Brukere i de siste 24 timene',
            'score' => 'Bidrag av Spillresultater i de siste 24 timene',
        ],
        'current' => 'Nåværende Påloggede Brukere',
        'score' => 'Bidrag av Spillresultater per Sekund',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Tidligere Hendelser',
            'state' => [
                'resolved' => 'Løst',
                'resolving' => 'Løser',
                'unknown' => 'Ukjent',
            ],
        ],

        'uptime' => [
            'title' => 'Driftstid',
            'graphs' => [
                'server' => 'server',
                'web' => 'nett',
            ],
        ],

        'when' => [
            'today' => 'i dag',
            'week' => 'uke',
            'month' => 'måned',
            'all_time' => 'all tid',
            'last_week' => 'forrige uke',
            'weeks_ago' => ':count_delimited uke siden|:count_delimited uker siden',
        ],
    ],
];
