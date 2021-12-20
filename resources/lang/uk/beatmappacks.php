<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Попередньо упаковані колекції карт, засновані на загальних темах.',
        'nav_title' => 'список',
        'title' => 'Збірки карт',

        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ЦЕ ПЕРЕД ЗАВАНТАЖЕННЯМ',
            'install_instruction' => '',
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
        'no_diff_reduction' => [
            '_' => ':link може не використовуватися для очищення цього пакета.',
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
