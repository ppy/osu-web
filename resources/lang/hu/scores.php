<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'non_preserved' => 'Ez a pontszám törlésre van megjelölve, és hamarosan eltűnik.',
        'title' => ':username ezen :title [:version]',

        'beatmap' => [
            'by' => ':artist dala',
        ],

        'player' => [
            'by' => 'Játékos',
            'played_on' => 'Játszva ekkor',
            'submitted_on' => 'Beküldve',
            'watched' => 'Megnézve',
            'watched_count' => ':count_delimited idő|:count_delimited alkalommal',

            'rank' => [
                'country' => 'Országos rangsor',
                'global' => 'Globális rangsor',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Csak a legjobb személyes pontszámok adnak pp-t',
        'no_pp' => 'pp nem jár ezért a pontszámért',
        'processing' => 'Ez a pontszám még értékelés alatt van és hamarosan mutatva lesz',
        'no_rank' => 'Ez a pontszám nem rendelkezik rankkal vagy törölésre van megjelölve',
    ],
];
