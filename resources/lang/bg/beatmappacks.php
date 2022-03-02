<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Предварително пакетирани колекции от бийтмапове, базирани на обща тема.',
        'nav_title' => 'пакети',
        'title' => 'Бийтмап пакети',

        'blurb' => [
            'important' => 'ПРОЧЕТИ ТОВА ПРЕДИ ИЗТЕГЛЯНЕ',
            'install_instruction' => 'Инсталиране: след изтегляне на пакет с песни, разархивирайте съдържанието на файла във вашата osu! директория, папка Songs, и osu! ще свърши останалата работа. ',
            'note' => [
                '_' => 'Също, препоръчително е да :scary, защото старите бийтмапове са с много по-ниско качество от най-новите.',
                'scary' => 'изтегляте пакетите от най-нови към най-стари',
            ],
        ],
    ],

    'show' => [
        'download' => 'Изтегляне',
        'item' => [
            'cleared' => 'преминат',
            'not_cleared' => 'не е преминат',
        ],
        'no_diff_reduction' => [
            '_' => ':link не се използват, за да бъде означен пакетът като преминат.',
            'link' => 'Модове променящи трудност',
        ],
    ],

    'mode' => [
        'artist' => 'Автор / Албум',
        'chart' => 'Под прожекторите',
        'standard' => 'Стандартни',
        'theme' => 'Тема',
    ],

    'require_login' => [
        '_' => 'Трябва да сте :link, за да изтеглите',
        'link_text' => 'влезли в профила си',
    ],
];
