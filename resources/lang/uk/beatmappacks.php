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
        'description' => 'Попередньо упаковані колекції карт, засновані на загальних темах.',
        'nav_title' => 'список',
        'title' => 'Збірки карт',

        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ЦЕ ПЕРЕД ЗАВАНТАЖЕННЯМ',
            'instruction' => [
                '_' => "Установка: як тільки ви завантажили карту, розпакуйте вміст .rar архіву в папку osu! > Songs.
                     Всі пісні всередині збірки будуть в форматі .zip і / чи .osz, тому osu! потрібно їх розпакувати в наступний раз, коли ви почнете грати.
                     Просимо :scary розпаковувати ці файли самостійно,
                     так як карта може відображатися некоректно в osu! і не працювати.",
                'scary' => 'НЕ',
            ],
            'note' => [
                '_' => 'Також, радимо вам :scary, так як старі карти сильно поступаються якістю на відміну від нових.',
                'scary' => 'завантажувати карти, починаючи з свіжих',
            ],
        ],
    ],

    'show' => [
        'download' => 'Завантажити',
        'item' => [
            'cleared' => 'завершено',
            'not_cleared' => 'не завершено',
        ],
    ],

    'mode' => [
        'artist' => 'Виконавці/Альбоми',
        'chart' => 'Чарти',
        'standard' => 'Стандартні',
        'theme' => 'Тематичні',
    ],

    'require_login' => [
        '_' => 'Ви повинні :link для завантаження',
        'link_text' => 'увійти',
    ],
];
