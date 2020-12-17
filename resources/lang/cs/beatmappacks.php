<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Kolekce beatmap s podobnou tématikou.',
        'nav_title' => 'seznam',
        'title' => 'Balíčky beatmap',

        'blurb' => [
            'important' => 'PŘEČTĚTE SI PŘED STAŽENÍM',
            'instruction' => [
                '_' => "Instalace: Po stažení balíčku musíš extrahovat soubor s příponou .rar do tvé složky s beatmapami. Všechny písničky v balíčku jsou stále ve formátu .zip a/nebo .osz, takže si je bude muset osu! extrahovat samo po vstupu do Selection menu.
                    :scary extrahovat soubory typu .zip nebo .osz sami,
                    nebo se beatmapy nezobrazí správně a nebudou fungovat.",
                'scary' => 'NESMÍTE',
            ],
            'note' => [
                '_' => 'Dále doporučujeme, abyste si :scary, jelikož starší mapy bývají horší kvality než ty novější.',
                'scary' => 'stahovali balíčky od nejnovějšího po nejstarší',
            ],
        ],
    ],

    'show' => [
        'download' => 'Stáhnout',
        'item' => [
            'cleared' => 'splněno',
            'not_cleared' => 'nesplněno',
        ],
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
        ],
    ],

    'mode' => [
        'artist' => 'Interpret/Album',
        'chart' => 'V záři reflektorů',
        'standard' => 'Klasické',
        'theme' => 'Tématické',
    ],

    'require_login' => [
        '_' => 'Pro stažení musíte být :link',
        'link_text' => 'příhlášený',
    ],
];
