<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'header' => [
        'title' => 'stav',
        'description' => 'čo sa deje kámo?',
    ],

    'incidents' => [
        'title' => 'Aktívne Incidenty',
        'automated' => 'automatizovaný',
    ],

    'online' => [
        'title' => [
            'users' => 'Online užívatelia za posledných 24 hodín',
            'score' => 'Predložené skóre za posledných 24 hodín',
        ],
        'current' => 'Aktuálni Online Užívatelia',
        'score' => 'Odoslaných Skóre za Sekundu',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Nedávne Incidenty',
            'state' => [
                'resolved' => 'Vyriešené',
                'resolving' => 'Riešenie',
                'unknown' => 'Neznáme',
            ],
        ],

        'uptime' => [
            'title' => 'Doba prevozu',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'dnes',
            'week' => 'týždeň',
            'month' => 'mesiac',
            'all_time' => 'vždy',
            'last_week' => 'posledný týždeň',
            'weeks_ago' => 'pred:count týždňom|pred:count týždňami',
        ],
    ],
];
