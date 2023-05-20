<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Kolekce beatmap s podobnou tématikou.',
        'empty' => 'Již brzy!',
        'nav_title' => 'seznam',
        'title' => 'Balíčky beatmap',

        'blurb' => [
            'important' => 'PŘEČTĚTE SI PŘED STAŽENÍM',
            'install_instruction' => 'Instalace: Jakmile bude balíček stažen, rozbalte jej do složky osu! skladeb a osu! udělá zbytek.',
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
            '_' => ':link nelze použít ke splnění tohoto balíčku.',
            'link' => 'Módy snižování obtížnosti',
        ],
    ],

    'mode' => [
        'artist' => 'Interpret/Album',
        'chart' => 'V záři reflektorů',
        'featured' => 'Vybraní umělci',
        'standard' => 'Klasické',
        'theme' => 'Tématické',
        'tournament' => 'Turnaj',
    ],

    'require_login' => [
        '_' => 'Pro stažení musíte být :link',
        'link_text' => 'přihlášený',
    ],
];
