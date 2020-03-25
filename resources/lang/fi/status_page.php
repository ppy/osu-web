<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'tila',
        'description' => 'kuis hurisee?',
    ],

    'incidents' => [
        'title' => 'Aktiiviset tapahtumat',
        'automated' => 'automatisoitu',
    ],

    'online' => [
        'title' => [
            'users' => 'Paikalla olevia käyttäjiä viimeisen 24 tunnin aikana',
            'score' => 'Pelikerrat viimeisen 24 tunnin aikana',
        ],
        'current' => 'Tällä hetkellä paikalla olevat käyttäjät',
        'score' => 'Peliä sekunnissa',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Viimeisimmät Tapahtumat',
            'state' => [
                'resolved' => 'Ratkaistu',
                'resolving' => 'Ratkaistaan',
                'unknown' => 'Tuntematon',
            ],
        ],

        'uptime' => [
            'title' => 'Käynnissäoloaika',
            'graphs' => [
                'server' => 'palvelin',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'tänään',
            'week' => 'viikko',
            'month' => 'kuukausi',
            'all_time' => 'koko aika',
            'last_week' => 'viime viikko',
            'weeks_ago' => ':count viikko sitten|:count viikkoa sitten',
        ],
    ],
];
