<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'jo man, wat is er allemaal aan de hand?',
    ],

    'incidents' => [
        'title' => 'Actieve Incidenten',
        'automated' => 'geautomatiseerd',
    ],

    'online' => [
        'title' => [
            'users' => 'Online Gebruikers in de afgelopen 24 uur',
            'score' => 'Score Inzendingen in de afgelopen 24 uur',
        ],
        'current' => 'Momenteel Online Gebruikers',
        'score' => 'Score Inzendingen per Seconde',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Recente Incidenten',
            'state' => [
                'resolved' => 'Opgelost',
                'resolving' => 'Aan het oplossen',
                'unknown' => 'Onbekend',
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
            'today' => 'vandaag',
            'week' => 'week',
            'month' => 'maand',
            'all_time' => 'altijd',
            'last_week' => 'afgelopen week',
            'weeks_ago' => ':count week geleden|:count weken geleden',
        ],
    ],
];
