<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Налаштування успішно збережено',
        'title' => 'Налаштування команди',

        'description' => [
            'label' => 'Опис',
            'title' => 'Опис команди',
        ],

        'header' => [
            'label' => 'Обкладинка',
            'title' => 'Встановити обкладинку',
        ],

        'logo' => [
            'label' => 'Прапор команди',
            'title' => 'Встановити прапор команди',
        ],

        'settings' => [
            'application' => 'Подавати заявки',
            'application_help' => 'Чи дозволяти користувачам подавати заявку на вступ в команду',
            'default_ruleset' => 'Режим гри',
            'default_ruleset_help' => 'Режим гри, який буде обрано при відвідуванні сторінки команди',
            'title' => 'Налаштування команди',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Закрита',
                'state_1' => 'Відкрита',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Учасника видалено',
        ],

        'index' => [
            'title' => 'Керувати учасниками',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Статус',
                'joined_at' => 'Дата приєднання',
                'remove' => 'Видалити',
                'title' => 'Наявні учасники',
            ],

            'status' => [
                'status_0' => 'Неактивний',
                'status_1' => 'Активний',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Створена',
            'website' => 'Сайт',
        ],

        'members' => [
            'members' => 'Учасники команди',
            'owner' => 'Лідер команди',
        ],

        'sections' => [
            'info' => 'Інформація',
            'members' => 'Учасники',
        ],
    ],
];
