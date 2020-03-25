<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'co się właśnie dzieje?',
    ],

    'incidents' => [
        'title' => 'Obecne problemy',
        'automated' => 'zautomatyzowane',
    ],

    'online' => [
        'title' => [
            'users' => 'Liczba użytkowników online w ciągu ostatnich 24 godzin',
            'score' => 'Liczba wysłanych wyników w ciągu ostatnich 24 godzin',
        ],
        'current' => 'Obecnie online',
        'score' => 'Liczba wysyłanych wyników na sekundę',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Niedawne problemy',
            'state' => [
                'resolved' => 'Rozwiązane',
                'resolving' => 'W trakcie rozwiązywania',
                'unknown' => 'Nieznane',
            ],
        ],

        'uptime' => [
            'title' => 'Czas pracy',
            'graphs' => [
                'server' => 'serwer',
                'web' => 'strona',
            ],
        ],

        'when' => [
            'today' => 'dzisiaj',
            'week' => 'tydzień',
            'month' => 'miesiąc',
            'all_time' => 'od zawsze',
            'last_week' => 'ostatni tydzień',
            'weeks_ago' => ':count_delimited tydzień temu|:count_delimited tygodnie temu:count_delimited tygodni temu',
        ],
    ],
];
