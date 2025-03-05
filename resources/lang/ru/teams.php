<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Игрок добавлен в команду.',
        ],
        'destroy' => [
            'ok' => 'Запрос на вступление отменен.',
        ],
        'reject' => [
            'ok' => 'Запрос на вступление отклонен.',
        ],
        'store' => [
            'ok' => 'Запрос отправлен.',
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
        'ok' => 'Команда удалена',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Настройки команды',

        'description' => [
            'label' => 'Описание',
            'title' => 'Описание команды',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Обложка',
            'title' => 'Загрузить обложку',
        ],

        'settings' => [
            'application_help' => 'Разрешить ли игрокам подавать заявки на вступление в команду',
            'default_ruleset_help' => 'Режим игры, отображаемый при открытии страницы команды',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Настройки команды',

            'application_state' => [
                'state_0' => 'Закрыта',
                'state_1' => 'Открыта',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'настройки',
        'leaderboard' => 'таблица лидеров',
        'show' => 'информация',

        'members' => [
            'index' => 'управление участниками',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Рейтинг в мире',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Участник успешно выгнан',
        ],

        'index' => [
            'title' => 'Управление участниками',

            'applications' => [
                'empty' => 'Нет запросов на вступление.',
                'empty_slots' => 'Свободных мест',
                'title' => 'Запросы на вступление',
                'created_at' => 'Запрос отправлен в',
            ],

            'table' => [
                'status' => 'Статус',
                'joined_at' => 'Дата вступления',
                'remove' => 'Выгнать',
                'title' => 'Текущие участники',
            ],

            'status' => [
                'status_0' => 'Неактивный',
                'status_1' => 'Активный',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Вы покинули команду ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Удалить команду',
            'join' => 'Отправить запрос',
            'join_cancel' => 'Отменить запрос',
            'part' => 'Покинуть команду',
        ],

        'info' => [
            'created' => 'Сформирована',
        ],

        'members' => [
            'members' => 'Участники команды',
            'owner' => 'Капитан команды',
        ],

        'sections' => [
            'info' => 'Информация',
            'members' => 'Участники',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
