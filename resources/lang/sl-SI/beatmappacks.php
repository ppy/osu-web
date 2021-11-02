<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
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
