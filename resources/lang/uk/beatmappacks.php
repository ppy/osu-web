<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Попередньо впаковані колекції карт, засновані на загальних темах.',
        'nav_title' => 'список',
        'title' => 'Збірки карт',

        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ЦЕ ПЕРЕД ЗАВАНТАЖЕННЯМ',
            'install_instruction' => 'Установлення: Як тільки набір буде завантажено, розпакуйте вміст набору в директорії osu! в папку "Songs"; osu! зробить усе инше.',
            'note' => [
                '_' => 'Також радимо вам :scary, оскільки старі мапи сильно поступаються якістю новим.',
                'scary' => 'завантажувати мапи, починаючи зі свіжих',
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
            '_' => ':link можуть не використовуватися для завершення цього набору.',
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
