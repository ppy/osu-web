<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Користувача додано у команду.',
        ],
        'destroy' => [
            'ok' => 'Запит на вступ відкликано.',
        ],
        'reject' => [
            'ok' => 'Запит на вступ відхилено.',
        ],
        'store' => [
            'ok' => 'Запрошено вступ до команди.',
        ],
    ],

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => 'Команду видалено',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Налаштування команди',

        'description' => [
            'label' => 'Опис',
            'title' => 'Опис команди',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Обкладинка',
            'title' => 'Встановити обкладинку',
        ],

        'settings' => [
            'application_help' => 'Чи дозволяти користувачам подавати заявку на вступ в команду',
            'default_ruleset_help' => 'Режим гри, який буде обрано при відвідуванні сторінки команди',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Налаштування команди',

            'application_state' => [
                'state_0' => 'Закрита',
                'state_1' => 'Відкрита',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'налаштування',
        'leaderboard' => 'таблиця лідерів',
        'show' => 'інформація',

        'members' => [
            'index' => 'керувати учасниками',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Рейтинг у світі',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Учасника видалено',
        ],

        'index' => [
            'title' => 'Керувати учасниками',

            'applications' => [
                'empty' => 'Наразі немає запитів на вступ.',
                'empty_slots' => 'Доступні слоти',
                'title' => 'Запити на вступ',
                'created_at' => 'Запитано',
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
        'ok' => 'Команду покинуто ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Розпустити команду',
            'join' => 'Запит на вступ',
            'join_cancel' => 'Скасувати запит',
            'part' => 'Покинути команду',
        ],

        'info' => [
            'created' => 'Створена',
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

    'store' => [
        'ok' => '',
    ],
];
