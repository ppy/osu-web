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
        'description' => 'Beatmapų kolekcijos pagal temas.',
        'nav_title' => '',
        'title' => 'Beatmapų kolekcijos',

        'blurb' => [
            'important' => 'PERSKAITYK PRIEŠ ATSISIŲSDAMAS',
            'instruction' => [
                '_' => "Įkėlimas: Kai parsisiųsi, išskleisk parsiųstą .rar failą į savo osu! \"Songs\" aplankalą.
                    Visos dainos bus .zip ir/arba .osz archyvuose, ir osu! turės jas išskleisti prieš einant į žaidimo dainų meniu.
                    :scary pats neišskleidinėk iš .zip/.osz archyvų,
                    kitaip beatmapai bus atvaizduojami neteisingai ir veiks blogai.",
                'scary' => 'JOKIU Būdu',
            ],
            'note' => [
                '_' => 'Taip pat yra rekomenduojama :scary, nes senesni mapai yra daug blogesnės kokybės lyginant su naujesniais.',
                'scary' => 'siųstis nuo naujausiu iki seniausių',
            ],
        ],
    ],

    'show' => [
        'download' => 'Parsisiuntimai',
        'item' => [
            'cleared' => 'išvalyta',
            'not_cleared' => 'neišvalyta',
        ],
    ],

    'mode' => [
        'artist' => 'Atlikėjas/Albumas',
        'chart' => 'Verti dėmesio',
        'standard' => 'Įprasti',
        'theme' => 'Pagal temas',
    ],

    'require_login' => [
        '_' => 'Parsisiuntimui jums reikia :link',
        'link_text' => 'prisijungti',
    ],
];
