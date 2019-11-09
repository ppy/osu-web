<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'WAŻNE',
            'instruction' => [
                '_' => "Instalacja: Gdy paczka zostanie pobrana,
                wypakuj plik .rar w folderze z beatmapami (Songs).
                Wszystkie beatmapy w paczce będą nadal miały
                rozszerzenie .zip czy .osz, dlatego osu! rozpakuje je
                przy przejściu do ekranu listy beatmap.
                :scary wypakowuj tych plików samodzielnie, inaczej nie
                będą one funkcjonowały prawidłowo.",
                'scary' => 'Nie',
            ],
            'note' => [
                '_' => ':scary jest wysoko zalecane, ponieważ starsze mapy znacznie odstają jakością od nowszych.',
                'scary' => 'Pobieranie paczek beatmap od najnowszych do najstarszych',
            ],
        ],
        'title' => 'Paczki beatmap',
        'description' => 'Kolekcje beatmap o wspólnej tematyce.',
    ],

    'show' => [
        'back' => '',
        'download' => 'Pobierz',
        'item' => [
            'cleared' => 'ukończona',
            'not_cleared' => 'nieukończona',
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
