<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'állapot',
        'description' => 'MEGHALT -RatinA0 2018',
    ],

    'incidents' => [
        'title' => 'Aktív Incidensek',
        'automated' => 'automatizált',
    ],

    'online' => [
        'title' => [
            'users' => 'Elérhető Felhasználók az elmúlt 24 órában',
            'score' => 'Pontszám beküldések az elmúlt 24 órában',
        ],
        'current' => 'Jelenleg Elérhető Felhasználók',
        'score' => 'Pontszám beküldések másodpercenként',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Legutóbbi Incidensek',
            'state' => [
                'resolved' => 'Megoldott',
                'resolving' => 'Megoldás alatt',
                'unknown' => 'Ismeretlen',
            ],
        ],

        'uptime' => [
            'title' => 'Üzemidő',
            'graphs' => [
                'server' => 'szerver',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'ma',
            'week' => 'hét',
            'month' => 'hónap',
            'all_time' => 'összes',
            'last_week' => 'múlt hét',
            'weeks_ago' => ':count héttel ez előtt |:count héttel ez előtt',
        ],
    ],
];
