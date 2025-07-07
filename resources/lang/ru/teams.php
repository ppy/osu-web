<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Игрок принят в команду.',
        ],
        'destroy' => [
            'ok' => 'Запрос на вступление отозван.',
        ],
        'reject' => [
            'ok' => 'Запрос на вступление отклонён.',
        ],
        'store' => [
            'ok' => 'Запрос на вступление отправлен.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited участник|:count_delimited участника|:count_delimited участников',
    ],

    'create' => [
        'submit' => 'Создать команду!',

        'form' => [
            'name_help' => 'Название вашей команды. Пока что его нельзя будет изменить.',
            'short_name_help' => 'Максимум 4 символа.',
            'title' => "Приступим к созданию новой команды",
        ],

        'intro' => [
            'description' => "Играйте вместе с друзьями, создав свою команду или заводите новых, вступая в существующие! Сейчас вы не состоите в команде.",
            'title' => 'Команда!',
        ],
    ],

    'destroy' => [
        'ok' => 'Команда распущена.',
    ],

    'edit' => [
        'ok' => 'Настройки сохранены.',
        'title' => 'Настройки команды',

        'description' => [
            'label' => 'Описание',
            'title' => 'Описание команды',
        ],

        'flag' => [
            'label' => 'Флаг команды',
            'title' => 'Загрузить флаг',
        ],

        'header' => [
            'label' => 'Обложка',
            'title' => 'Загрузить обложку',
        ],

        'settings' => [
            'application_help' => 'Разрешить ли всем желающим подавать запросы на вступление в команду',
            'default_ruleset_help' => 'Режим игры, отображаемый на главной странице команды',
            'flag_help' => 'Максимальный размер: :width×:height',
            'header_help' => 'Максимальный размер: :width×:height',
            'title' => 'Настройки команды',

            'application_state' => [
                'state_0' => 'Закрыта',
                'state_1' => 'Открыта',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'настройки',
        'leaderboard' => 'рейтинг',
        'show' => 'главная',

        'members' => [
            'index' => 'управление участниками',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Рейтинг в мире',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Участник команды успешно исключён',
        ],

        'index' => [
            'title' => 'Управление участниками',

            'applications' => [
                'accept_confirm' => 'Принять игрока :user в команду?',
                'created_at' => 'Запрос отправлен',
                'empty' => 'Нет запросов на вступление.',
                'empty_slots' => 'Свободных мест',
                'empty_slots_overflow' => 'переполнена на :count_delimited игрока|переполнена на :count_delimited игроков',
                'reject_confirm' => 'Отклонить запрос на вступление игрока :user?',
                'title' => 'Запросы на вступление',
            ],

            'table' => [
                'joined_at' => 'Дата вступления',
                'remove' => 'Исключить',
                'remove_confirm' => 'Исключить игрока :user из команды?',
                'set_leader' => 'Передать права управления',
                'set_leader_confirm' => 'Передать титул капитана команды игроку :user?',
                'status' => 'Статус',
                'title' => 'Текущие участники',
            ],

            'status' => [
                'status_0' => 'Неактивный',
                'status_1' => 'Активный',
            ],
        ],

        'set_leader' => [
            'success' => 'Теперь игрок :user — новый капитан команды.',
        ],
    ],

    'part' => [
        'ok' => 'Вы покинули команду ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Командный чат',
            'destroy' => 'Распустить команду',
            'join' => 'Вступить в команду',
            'join_cancel' => 'Отозвать запрос',
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
            'about' => 'О нас!',
            'info' => 'Общее',
            'members' => 'Участники',
        ],

        'statistics' => [
            'rank' => 'Рейтинг в мире',
            'leader' => 'Капитан команды',
        ],
    ],

    'store' => [
        'ok' => 'Команда создана.',
    ],
];
