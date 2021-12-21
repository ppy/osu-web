<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Kolekcje beatmap o wspólnej tematyce.',
        'nav_title' => 'lista',
        'title' => 'Paczki beatmap',

        'blurb' => [
            'important' => 'WAŻNE',
            'install_instruction' => '',
            'note' => [
                '_' => ':scary jest wysoko zalecane, ponieważ starsze mapy znacznie odstają jakością od nowszych.',
                'scary' => 'Pobieranie paczek beatmap od najnowszych do najstarszych',
            ],
        ],
    ],

    'show' => [
        'download' => 'Pobierz',
        'item' => [
            'cleared' => 'ukończona',
            'not_cleared' => 'nieukończona',
        ],
        'no_diff_reduction' => [
            '_' => 'Nie możesz korzystać z :link do zaliczania beatmap z tej paczki.',
            'link' => 'modyfikatorów ułatwiających rozgrywkę',
        ],
    ],

    'mode' => [
        'artist' => 'Artysta/Album',
        'chart' => 'Wyróżnione',
        'standard' => 'Standardowe',
        'theme' => 'Tematyczne',
    ],

    'require_login' => [
        '_' => 'Aby pobrać tę paczkę, musisz się :link',
        'link_text' => 'zalogować',
    ],
];
