<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'LUE TÄMÄ ENNEN LATAAMISTA',
            'instruction' => [
                '_' => "Asennus: Kun paketti on ladattu, pura .rar tiedosto osu! Songs kansioon.
                 Kappaleet ovat vielä .zip ja/tai .osz muodossa paketin sisällä, joten osu! purkaa beatmapit seuraavalla pelikerrallla.
                 :scary pura .zip/.osz-tiedostoja itse,
                 tai beatmapit eivät näy oikein pelissä eivätkä toimi kunnolla.",
                'scary' => 'ÄLÄ',
            ],
            'note' => [
                '_' => 'Huomaa myös, että on erittäin suositeltavaa :scary, koska vanhemmat mapit ovat paljon huonompia kuin uudet.',
                'scary' => 'ladata uusimpia kokoelmia vanhojen sijaan',
            ],
        ],
        'title' => 'Beatmap-Kokoelmat',
        'description' => 'Valmiiksi kasattuja beatmap kokoelmia, joissa yhdistyy tietty teema.',
    ],

    'show' => [
        'back' => '',
        'download' => 'Lataa',
        'item' => [
            'cleared' => 'läpäisty',
            'not_cleared' => 'läpäisemätön',
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
