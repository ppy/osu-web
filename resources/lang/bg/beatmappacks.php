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
        'description' => 'Предварително пакетирани колекции от бийтмапове, базирани на обща тема.',
        'nav_title' => '',
        'title' => 'Бийтмап пакети',

        'blurb' => [
            'important' => 'ПРОЧЕТЕТЕ ТОВА ПРЕДИ ИЗТЕГЛЯНЕ',
            'instruction' => [
                '_' => "Инсталация: След като изтеглите пакет с песни, разархивирайте .rar файла във вашата osu! директория, папка Songs.
                    Всички песни са взе още .zip-нати и/или .osz-нати във пакета, така че osu! ще трябва да ги разархивира от само себе си следващия път като пуснете играта.
                    :scary разархивирайте .zip/.osz файловете сами
                    или бийтмаповете ще се покажат неправилно в osu! и няма да работят правилно.",
                'scary' => 'НЕДЕЙТЕ',
            ],
            'note' => [
                '_' => 'Също, препоръчително е да :scary, защото старите мапове са с много по-ниско качество от най-новите мапове.',
                'scary' => 'изтеглите пакетите от най-новите към най-старите',
            ],
        ],
    ],

    'show' => [
        'download' => 'Изтегли',
        'item' => [
            'cleared' => 'преминат',
            'not_cleared' => 'не преминат',
        ],
    ],

    'mode' => [
        'artist' => 'Артист/Албум',
        'chart' => 'Препоръчани',
        'standard' => 'Стандартен',
        'theme' => 'Тема',
    ],

    'require_login' => [
        '_' => 'Трябва да сте :link за да изтеглите',
        'link_text' => 'влезли в профила си',
    ],
];
