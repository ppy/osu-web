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
        'saved' => 'Настройките са запазени успешно',
        'title' => 'Отборни настройки',

        'description' => [
            'label' => 'Описание',
            'title' => 'Описание на отбора',
        ],

        'header' => [
            'label' => 'Заглавна снимка',
            'title' => 'Задай заглавна снимка',
        ],

        'logo' => [
            'label' => 'Отборно знаме',
            'title' => 'Задай отборно знаме',
        ],

        'settings' => [
            'application' => 'Отборни заявки',
            'application_help' => 'Дали да е разрешено за потребители да заявяват отбор',
            'default_ruleset' => 'Основни правила',
            'default_ruleset_help' => 'Правилата да се избират подразбиране при посещение на отборната страница',
            'title' => 'Отборни настройки',
            'url' => 'Връзка',

            'application_state' => [
                'state_0' => 'Затворен',
                'state_1' => 'Отворен',
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
            'success' => 'Отборният член е премахнат',
        ],

        'index' => [
            'title' => 'Управление на членове',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Състояние',
                'joined_at' => 'Дата на присъединяване',
                'remove' => 'Премахване',
                'title' => 'Текущи членове',
            ],

            'status' => [
                'status_0' => 'Неактивни',
                'status_1' => 'Активни',
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
            'created' => 'Учреден',
            'website' => 'Уебсайт',
        ],

        'members' => [
            'members' => 'Членове в отбора',
            'owner' => 'Лидер на отбора',
        ],

        'sections' => [
            'info' => 'Инфо',
            'members' => 'Членове',
        ],
    ],
];
