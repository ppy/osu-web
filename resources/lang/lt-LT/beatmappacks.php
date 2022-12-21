<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Beatmapų kolekcijos pagal temas.',
        'nav_title' => 'sąrašas',
        'title' => 'Bitmapų Rinkiniai',

        'blurb' => [
            'important' => 'PERSKAITYK PRIEŠ ATSISIŲSDAMAS',
            'install_instruction' => 'Diegimas: Kai persisiųsi rinkinį, išskleisk rinkinio tūrinį į osu! dainų katalogą ir osu! padarys visą kitą.',
            'note' => [
                '_' => 'Taip pat yra rekomenduojama :scary, nes senesni bitmapai yra daug blogesnės kokybės lyginant su naujesniais.',
                'scary' => 'siųstis nuo naujausiu iki seniausių',
            ],
        ],
    ],

    'show' => [
        'download' => 'Atsisiųsti',
        'item' => [
            'cleared' => 'išvalyta',
            'not_cleared' => 'neišvalyta',
        ],
        'no_diff_reduction' => [
            '_' => ':link negali būti naudojami šio rinkinio įveikimui.',
            'link' => 'Sunkumą mažinantis modai',
        ],
    ],

    'mode' => [
        'artist' => 'Atlikėjas/Albumas',
        'chart' => 'Verti dėmesio',
        'standard' => 'Įprasti',
        'theme' => 'Teminiai',
    ],

    'require_login' => [
        '_' => 'Parsisiuntimui jums reikia :link',
        'link_text' => 'prisijungti',
    ],
];
