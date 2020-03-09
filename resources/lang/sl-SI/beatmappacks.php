<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'description' => 'Zapakirane zbirke beatmapov na skupno temo.',
        'nav_title' => '',
        'title' => 'Paketi beatmapov',

        'blurb' => [
            'important' => 'PREBERITE TO, PREDEN PRENESETE',
            'instruction' => [
                '_' => "Namestitev: Ko ste prenesli paket, skopirajte vsebino datoteke .rar v svoj osu! direktorij z imenom Songs.
                    Vse pesmi v paketu so še zmeraj zapakirane v .zip ali .osz datoteki, zato bo moral !osu beatmape izvleči ven naslednjič, ko greste v igralni način.
                    :scary razširite .zip / .osz datotek sami,
                    ali pa bodo beatmapi nepravilno prikazani in osu! ne bo pravilno deloval.",
                'scary' => 'NE',
            ],
            'note' => [
                '_' => 'Pomnite, da je zelo priporočljivo, da :scary, saj so starejši mapi veliko manj kvalitetni kot najnovejši.',
                'scary' => 'prenesete najprej najnovejše pakete',
            ],
        ],
    ],

    'show' => [
        'download' => 'Prenesite',
        'item' => [
            'cleared' => 'opravljeno',
            'not_cleared' => 'neopravljeno',
        ],
    ],

    'mode' => [
        'artist' => 'Glasbenik/Album',
        'chart' => 'Pod žarometi',
        'standard' => 'Standardni',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Za prenašanje morate biti :link',
        'link_text' => 'prijavljeni',
    ],
];
