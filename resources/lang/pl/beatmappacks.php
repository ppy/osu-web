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
        'description' => 'Kolekcje beatmap o wspólnej tematyce.',
        'nav_title' => 'lista',
        'title' => 'Paczki beatmap',

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
    ],

    'show' => [
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
