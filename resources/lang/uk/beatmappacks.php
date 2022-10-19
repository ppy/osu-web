<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Попередньо впаковані колекції мап, засновані на загальних темах.',
        'nav_title' => 'список',
        'title' => 'Збірки мап',

        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ЦЕ ПЕРЕД ЗАВАНТАЖЕННЯМ',
            'install_instruction' => 'Встановлення: Як тільки набір буде завантажено, розпакуйте вміст набору в папку Songs в вашій директорії osu!, а гра все зробить за вас.',
            'note' => [
                '_' => 'Також радимо вам :scary, оскільки старі мапи сильно поступаються якістю новим.',
                'scary' => 'завантажувати набори, починаючи зі свіжих',
            ],
        ],
    ],

    'show' => [
        'download' => 'Завантажити',
        'item' => [
            'cleared' => 'завершено',
            'not_cleared' => 'не завершено',
        ],
        'no_diff_reduction' => [
            '_' => ':link не можна використовувати для завершення цього набору.',
            'link' => 'Моди зменшення складності ',
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
