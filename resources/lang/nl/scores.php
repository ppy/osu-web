<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'non_preserved' => '',
        'title' => ':username op :title [:version]',

        'beatmap' => [
            'by' => 'door :artist',
        ],

        'player' => [
            'by' => 'Gespeeld door',
            'submitted_on' => 'Ingediend op',

            'rank' => [
                'country' => 'Landelijke Ranglijst',
                'global' => 'Wereldwijde Ranglijst',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Enkel je beste score op een beatmap levert pp op',
        'no_pp' => 'pp word niet opgeleverd voor deze score',
        'processing' => 'Deze score wordt nog berekend en zal zo dadelijk getoond worden',
        'no_rank' => 'Deze score heeft geen rang omdat deze ongerangschikt is of gemarkeerd is voor verwijdering',
    ],
];
