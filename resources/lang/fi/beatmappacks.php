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
                 Kappaleet ovat vielä .zip ja/tai .osz muodossa paketin sisällä, joten osu! purkaa rytmikartat itse seuraavan kerran kun pelaat.
                 :scary pura .zip/.osz tiedostot itse,
                 tai rytmikartat eivät näy oikein osu!:ssa eivätkä toimi kunnolla.",
                'scary' => 'ÄLÄ',
            ],
            'note' => [
                '_' => 'Huomaa myös, että on erittäin suositeltavaa :scary, koska vanhimmat kappaleet ovat paljon huonompia kuin viimeaikaiset kappaleet.',
                'scary' => 'lataa pakkaukset viimeisistä aikaisempiin päin',
            ],
        ],
        'title' => 'Rytmikarttapaketit',
        'description' => 'Valmiiksi pakattuja rytmikarttakokoelmia tietyn aiheen ympäriltä.',
    ],

    'show' => [
        'download' => 'Lataa',
        'item' => [
            'cleared' => 'selvitetty',
            'not_cleared' => 'ei selvitetty',
        ],
    ],

    'mode' => [
        'artist' => 'Esijttäjä/Albumi',
        'chart' => 'Parrasvalo',
        'standard' => 'Standardi',
        'theme' => 'Teema',
    ],

    'require_login' => [
        '_' => 'Sinun täytyy olla :link lataaksesi',
        'link_text' => 'kirjautunut sisään',
    ],
];
