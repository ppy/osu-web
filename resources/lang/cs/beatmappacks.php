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
            'install_instruction' => '',
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
