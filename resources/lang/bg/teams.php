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

    'card' => [
        'members' => '',
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
        'title' => 'Отборни настройки',

        'description' => [
            'label' => 'Описание',
            'title' => 'Описание на отбора',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Заглавна снимка',
            'title' => 'Задай заглавна снимка',
        ],

        'settings' => [
            'application_help' => 'Дали да е разрешено за потребители да заявяват отбор',
            'default_ruleset_help' => 'Правилата да се избират подразбиране при посещение на отборната страница',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Отборни настройки',

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
    ],

    'members' => [
        'destroy' => [
            'success' => 'Отборният член е премахнат',
        ],

        'index' => [
            'title' => 'Управление на членове',

            'applications' => [
                'accept_confirm' => '',
                'created_at' => '',
                'empty' => '',
                'empty_slots' => '',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => '',
            ],

            'table' => [
                'joined_at' => 'Дата на присъединяване',
                'remove' => 'Премахване',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Състояние',
                'title' => 'Текущи членове',
            ],

            'status' => [
                'status_0' => 'Неактивни',
                'status_1' => 'Активни',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Учреден',
        ],

        'members' => [
            'members' => 'Членове в отбора',
            'owner' => 'Лидер на отбора',
        ],

        'sections' => [
            'about' => '',
            'info' => 'Инфо',
            'members' => 'Членове',
        ],

        'statistics' => [
            'rank' => '',
            'leader' => '',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
