<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'title' => ':username\'n tulos: :title [:version]',

        'beatmap' => [
            'by' => 'esittäjä :artist',
        ],

        'player' => [
            'by' => 'Pelaaja',
            'submitted_on' => 'Tulos lähetetty',

            'rank' => [
                'country' => 'Maakohtainen sijoitus',
                'global' => 'Maailmanlaajuinen sijoitus',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Vain parhaat henkilökohtaiset tulokset antavat pp\'tä',
        'non_passing' => 'Vain ne tulokset, joissa on päästy rytmikartan loppuun asti, antavat pp\'tä',
        'processing' => 'Pisteitä lasketaan ja ne näytetään pian',
    ],
];
