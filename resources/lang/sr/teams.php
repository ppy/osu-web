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
        'ok' => '',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Подешавања Тима',

        'description' => [
            'label' => 'Опис',
            'title' => 'Опис Тима',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => '',
            'title' => '',
        ],

        'settings' => [
            'application_help' => '',
            'default_ruleset_help' => '',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Подешавање Тима',

            'application_state' => [
                'state_0' => 'Затворено',
                'state_1' => 'Отворено',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'поставке',
        'leaderboard' => 'ранг листа',
        'show' => 'инфо',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Глобални Ранг',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Члан тима уклоњен',
        ],

        'index' => [
            'title' => 'Управљајте Чланове',

            'applications' => [
                'empty' => 'Тренутно нема захтева за придруживање.',
                'empty_slots' => 'Број доступних места',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Статус',
                'joined_at' => '',
                'remove' => 'Уклони',
                'title' => 'Тренутни чланови',
            ],

            'status' => [
                'status_0' => 'Неактивно',
                'status_1' => 'Активно',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Изашао/ла из тима ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '',
            'join' => 'Захтев за придруживање',
            'join_cancel' => 'Откажи захтев за придруживање',
            'part' => 'Изађи из тима',
        ],

        'info' => [
            'created' => '',
        ],

        'members' => [
            'members' => '',
            'owner' => '',
        ],

        'sections' => [
            'info' => 'Инфо',
            'members' => 'Чланови',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
