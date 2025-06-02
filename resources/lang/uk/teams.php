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

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'Створити команду',

        'form' => [
            'name_help' => 'Назва вашої команди. Наразі вона є незмінною.',
            'short_name_help' => 'Максимум 4 символи.',
            'title' => "Створімо нову команду",
        ],

        'intro' => [
            'description' => "Грайте разом з вашими друзями, або знайдіть нових! Наразі ви не перебуваєте в команді. Приєднайтеся до існуючої команди, відвідавши її сторінку, або створіть власну команду прямо тут.",
            'title' => 'Команда!',
        ],
    ],

    'destroy' => [
        'ok' => 'Команду видалено',
    ],

    'edit' => [
        'ok' => 'Налаштування успішно збережено.',
        'title' => 'Налаштування команди',

        'description' => [
            'label' => 'Опис',
            'title' => 'Опис команди',
        ],

        'flag' => [
            'label' => 'Прапор команди',
            'title' => 'Встановити прапор команди',
        ],

        'header' => [
            'label' => 'Обкладинка',
            'title' => 'Встановити обкладинку',
        ],

        'settings' => [
            'application_help' => 'Чи дозволяти користувачам подавати заявку на вступ в команду',
            'default_ruleset_help' => 'Режим гри, який буде обрано при відвідуванні сторінки команди',
            'flag_help' => 'Максимальний розмір: :width×:height',
            'header_help' => 'Максимальний розмір: :width×:height',
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
                'accept_confirm' => 'Додати користувача :user до команди?',
                'created_at' => 'Запитано',
                'empty' => 'Наразі немає запитів на вступ.',
                'empty_slots' => 'Доступні слоти',
                'empty_slots_overflow' => 'Переповнення на :count_delimited гравця|Переповнення на :count_delimited гравців',
                'reject_confirm' => 'Відхилити запит на приєднання від користувача :user?',
                'title' => 'Запити на вступ',
            ],

            'table' => [
                'joined_at' => 'Дата приєднання',
                'remove' => 'Видалити',
                'remove_confirm' => 'Виключити користувача :user з команди?',
                'set_leader' => 'Передати права керування командою',
                'set_leader_confirm' => 'Передати права керування командою користувачу :user?',
                'status' => 'Статус',
                'title' => 'Наявні учасники',
            ],

            'status' => [
                'status_0' => 'Неактивний',
                'status_1' => 'Активний',
            ],
        ],

        'set_leader' => [
            'success' => 'Користувач :user тепер керівник команди.',
        ],
    ],

    'part' => [
        'ok' => 'Команду покинуто ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Командний чат',
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
            'about' => 'Про нас!',
            'info' => 'Інформація',
            'members' => 'Учасники',
        ],

        'statistics' => [
            'rank' => 'Ранг',
            'leader' => 'Лідер команди',
        ],
    ],

    'store' => [
        'ok' => 'Команду створено.',
    ],
];
