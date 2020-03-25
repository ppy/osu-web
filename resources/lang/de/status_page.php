<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'was geht ab?',
    ],

    'incidents' => [
        'title' => 'Aktive Vorfälle',
        'automated' => 'automatisiert',
    ],

    'online' => [
        'title' => [
            'users' => 'In den letzten 24 Stunden aktive Nutzer',
            'score' => 'Abgesendete Scores in the last 24 Hours',
        ],
        'current' => 'Aktuell aktive Nutzer',
        'score' => 'Abgesendete Scores pro Sekunde',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Letzte Vorfälle',
            'state' => [
                'resolved' => 'Gelöst',
                'resolving' => 'Wird gelöst',
                'unknown' => 'Unbekannt',
            ],
        ],

        'uptime' => [
            'title' => 'Verfügbarkeit',
            'graphs' => [
                'server' => 'server',
                'web' => 'webseite',
            ],
        ],

        'when' => [
            'today' => 'heute',
            'week' => 'woche',
            'month' => 'monat',
            'all_time' => 'immer',
            'last_week' => 'letzte woche',
            'weeks_ago' => 'vor :count woche|vor :count wochen',
        ],
    ],
];
