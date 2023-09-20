<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'title' => ':username en :title [:version]',

        'beatmap' => [
            'by' => 'per :artist',
        ],

        'player' => [
            'by' => 'Jugat per',
            'submitted_on' => 'Enviat el',

            'rank' => [
                'country' => 'Classificació nacional',
                'global' => 'Classificació global',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Només les millors puntuacions personals atorguen pp',
        'non_passing' => 'Només les puntuacions aprovades atorguen pp',
        'processing' => 'Aquesta puntuació encara s\'està calculant i es mostrarà aviat',
    ],
];
