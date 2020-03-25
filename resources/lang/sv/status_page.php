<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'vad händer mina bekanta?',
    ],

    'incidents' => [
        'title' => 'Aktiva Incidenter',
        'automated' => 'automatiserad',
    ],

    'online' => [
        'title' => [
            'users' => 'Användare Online de senaste 24 timmarna',
            'score' => 'Poäng Inlämningar de senaste 24 timmarna',
        ],
        'current' => 'Nuvarande Användare Online',
        'score' => 'Poäng Inlämningar per Sekund',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Senaste Incidenter',
            'state' => [
                'resolved' => 'Löst',
                'resolving' => 'Skickar förfrågan',
                'unknown' => 'Okänd',
            ],
        ],

        'uptime' => [
            'title' => 'Upptid',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'idag',
            'week' => 'vecka',
            'month' => 'månad',
            'all_time' => 'all tid',
            'last_week' => 'förra veckan',
            'weeks_ago' => ':count vecka sedan|:count veckor sedan',
        ],
    ],
];
