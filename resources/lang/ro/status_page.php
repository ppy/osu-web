<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'ce se întamplă, omul meu?',
    ],

    'incidents' => [
        'title' => 'Incidente active',
        'automated' => 'automatizat',
    ],

    'online' => [
        'title' => [
            'users' => 'Utilizatori online în ultimele 24 de ore',
            'score' => 'Numărul de scoruri trimise în ultimele 24 de ore',
        ],
        'current' => 'Utilizatori online',
        'score' => 'Numărul de scoruri trimise pe secundă',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidente recente',
            'state' => [
                'resolved' => 'Rezolvat',
                'resolving' => 'Se rezolvă',
                'unknown' => 'Necunoscut',
            ],
        ],

        'uptime' => [
            'title' => 'Timpul de funcționare',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'astăzi',
            'week' => 'saptămână',
            'month' => 'lună',
            'all_time' => 'tot timpul',
            'last_week' => 'ultima săptămână',
            'weeks_ago' => ':count săptămână în urmă|:count săptămâni în urmă',
        ],
    ],
];
