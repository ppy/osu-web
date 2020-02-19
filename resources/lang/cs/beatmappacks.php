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
        'description' => 'Kolekce beatmap s podobnou tématikou.',
        'nav_title' => '',
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
