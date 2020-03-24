<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'hvad sker der min ven?',
    ],

    'incidents' => [
        'title' => 'Aktive Begivenheder',
        'automated' => 'automatiseret',
    ],

    'online' => [
        'title' => [
            'users' => 'Online Brugere i de seneste 24 timer',
            'score' => 'Score Indsendelser i de seneste 24 timer',
        ],
        'current' => 'Online Brugere i Øjeblikket',
        'score' => 'Score Indsendelser i sekundet',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Seneste Begivenheder',
            'state' => [
                'resolved' => 'Løst',
                'resolving' => 'Løser',
                'unknown' => 'Ukendt',
            ],
        ],

        'uptime' => [
            'title' => 'Oppetid',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'i dag',
            'week' => 'uge',
            'month' => 'måned',
            'all_time' => 'altid',
            'last_week' => 'sidste uge',
            'weeks_ago' => ':count uge siden|:count uger siden',
        ],
    ],
];
