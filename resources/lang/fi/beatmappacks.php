<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Valmiiksi kasattuja beatmap kokoelmia, joissa yhdistyy tietty teema.',
        'nav_title' => 'listaus',
        'title' => 'Beatmap-Kokoelmat',

        'blurb' => [
            'important' => 'LUE TÄMÄ ENNEN LATAAMISTA',
            'install_instruction' => '',
            'note' => [
                '_' => 'Huomaa myös, että on erittäin suositeltavaa :scary, koska vanhemmat mapit ovat paljon huonompia kuin uudet.',
                'scary' => 'ladata uusimpia kokoelmia vanhojen sijaan',
            ],
        ],
    ],

    'show' => [
        'download' => 'Lataa',
        'item' => [
            'cleared' => 'läpäisty',
            'not_cleared' => 'läpäisemätön',
        ],
        'no_diff_reduction' => [
            '_' => ':link ei voi käyttää tämän paketin suorittamiseen.',
            'link' => 'Vaikeusastetta vähentäviä modeja',
        ],
    ],

    'mode' => [
        'artist' => 'Esittäjä/Albumi',
        'chart' => 'Valokeilassa',
        'standard' => 'Tavallinen',
        'theme' => 'Teema',
    ],

    'require_login' => [
        '_' => 'Sinun täytyy olla :link ladataksesi',
        'link_text' => 'kirjautuneena sisään',
    ],
];
