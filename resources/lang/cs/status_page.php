<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'stav',
        'description' => 'co se děje kámo?',
    ],

    'incidents' => [
        'title' => 'Aktivní incidenty',
        'automated' => 'automatizovaný',
    ],

    'online' => [
        'title' => [
            'users' => 'Online uživatelé za posledních 24 hodin',
            'score' => 'Předložená skóre za posledních 24 hodin',
        ],
        'current' => 'Aktuálně online uživatelé',
        'score' => 'Odeslaných skóre za sekundu',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Nedávné incidenty',
            'state' => [
                'resolved' => 'Vyřešeno',
                'resolving' => 'Řešení',
                'unknown' => 'Neznámé',
            ],
        ],

        'uptime' => [
            'title' => 'Doba provozu',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'dnes',
            'week' => 'týden',
            'month' => 'měsíc',
            'all_time' => 'za celou dobu',
            'last_week' => 'poslední týden',
            'weeks_ago' => 'před :count týdnem|před :count týdny',
        ],
    ],
];
