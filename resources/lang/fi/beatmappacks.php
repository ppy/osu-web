<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
                '_' => 'Huomaa myös, että on erittäin suositeltavaa :scary, koska vanhimmat mapit ovat paljon huonompia kuin uusimmat mapit.',
                'scary' => 'ladata uusimpia kokoelmia vanhojen sijaan',
            ],
        ],
        'title' => 'Beatmap Kokoelmat',
        'description' => 'Valmiiksi pakattuja beatmap kokoelmia perustuen yleisiin teemoihin.',
    ],

    'show' => [
        'download' => 'Lataa',
        'item' => [
            'cleared' => 'läpäisty',
            'not_cleared' => 'ei läpäisty',
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
