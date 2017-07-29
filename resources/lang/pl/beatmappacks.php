<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'blurb' => [
            'important' => 'WAŻNE',
            'instruction' => [
                '_' => 'Instalacja: Kiedy paczka się pobierze, wypakuj .rar do folderu z mapami
                    Pliki map są nadal skompresowane, więc osu! rozpakuje pojedyńcze mapy zaraz po tym, jak wejdziesz w tryb gry.
                    :scary rozpakowywuj map sampodzielnie,
                    bądź mapy nie będą dobrze działały w osu!.',
                'scary' => 'NIE',
            ],
            'note' => [
                '_' => ':scary jest wysoko zalecane, ponieważ najstarsze mapy znacznie odstają jakością od nowszych.',
                'scary' => 'pobieranie paczek beatmap od najnowszych do najstarszych',
            ],
        ],
        'title' => 'Paczki beatmap',
        'description' => 'Kolekcje beatmap o wspólnej tematyce.',
    ],
    'show' => [
        'download' => 'Pobierz',
        'item' => [
            'cleared' => 'Ukończona',
            'not_cleared' => 'Nieukończona',
        ],
    ],
    'mode' => [
        'artist' => 'Artysta/Album',
        'chart' => 'Wyróżnione',
        'standard' => 'Standardowe',
        'theme' => 'Tematyczne',
    ],
    'require_login' => [
        '_' => 'Aby pobrać paczkę beatmap, musisz się :link',
        'link_text' => 'zalogować',
    ],
];
