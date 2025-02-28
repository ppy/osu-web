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
        'saved' => 'Настройки сохранены',
        'title' => 'Настройки команды',

        'description' => [
            'label' => 'Описание',
            'title' => 'Описание команды',
        ],

        'header' => [
            'label' => 'Обложка',
            'title' => 'Загрузить обложку',
        ],

        'logo' => [
            'label' => 'Флаг команды',
            'title' => 'Установить флаг команды',
        ],

        'settings' => [
            'application' => 'Подача заявок на вступление',
            'application_help' => 'Разрешить ли игрокам подавать заявки на вступление в команду',
            'default_ruleset' => 'Режим игры по умолчанию',
            'default_ruleset_help' => 'Режим игры, отображаемый при открытии страницы команды',
            'title' => 'Настройки команды',
            'url' => 'Ссылка',

            'application_state' => [
                'state_0' => 'Закрыта',
                'state_1' => 'Открыта',
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
            'success' => 'Участник успешно выгнан',
        ],

        'index' => [
            'title' => 'Управление участниками',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
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
            'created' => 'Сформирована',
            'website' => 'Веб-сайт',
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
];
