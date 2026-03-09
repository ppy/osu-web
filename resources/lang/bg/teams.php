<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Потребителят беше добавен към отбора.',
        ],
        'destroy' => [
            'ok' => 'Заявката беше отменена.',
        ],
        'reject' => [
            'ok' => 'Заявката беше отхвърлена.',
        ],
        'store' => [
            'ok' => 'Заяви да влезе в отбора.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited играч|:count_delimited играча',
    ],

    'create' => [
        'submit' => 'Създай отбор',

        'form' => [
            'name_help' => 'Името на вашият отбор. Името е перманентно за момента.',
            'short_name_help' => 'Максимум 4 символа.',
            'title' => "Нека конфигурираме новия отбор",
        ],

        'intro' => [
            'description' => "Играй заедно с приятели; стари или нови. Ти не си в отбор за момента. Влез в вече съществуващ отбор като отидеш на страницата на отбора им или създай твой собствен отбор от тази страница.",
            'title' => 'Отбор!',
        ],
    ],

    'destroy' => [
        'ok' => 'Отборът е премахнат.',
    ],

    'edit' => [
        'ok' => 'Настройките са запазени успешно.',
        'title' => 'Отборни настройки',

        'description' => [
            'label' => 'Описание',
            'title' => 'Описание на отбора',
        ],

        'flag' => [
            'label' => 'Знаме на отбора',
            'title' => 'Задай отборно знаме',
        ],

        'header' => [
            'label' => 'Заглавна снимка',
            'title' => 'Задай заглавна снимка',
        ],

        'settings' => [
            'application_help' => 'Дали да е разрешено за потребители да заявяват отбор',
            'default_ruleset_help' => 'Правилата да се избират подразбиране при посещение на отборната страница',
            'flag_help' => 'Максимален размер от :width×:height',
            'header_help' => 'Максимален размер от :width×:height',
            'title' => 'Отборни настройки',

            'application_state' => [
                'state_0' => 'Затворен',
                'state_1' => 'Отворен',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'настройки',
        'leaderboard' => 'класация',
        'show' => 'информация',

        'members' => [
            'index' => 'управление на участниците',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Глобално класиране',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Отборният член е премахнат',
        ],

        'index' => [
            'title' => 'Управление на членове',

            'applications' => [
                'accept_confirm' => 'Добавяне на :user към отбора?',
                'created_at' => 'Заявено на',
                'empty' => 'Няма заявки за влизане за момента.',
                'empty_slots' => 'Налични места',
                'empty_slots_overflow' => 'препълнен с :count_delimited потребители|препълнен с :count_delimited потребители',
                'reject_confirm' => 'Откажи заявката за влизане от потребител :user?',
                'title' => 'Заявки за присъединяване',
            ],

            'table' => [
                'joined_at' => 'Дата на присъединяване',
                'remove' => 'Премахване',
                'remove_confirm' => 'Премахни потребител :user от отбора?',
                'set_leader' => 'Пренасяне на отборното лидерство',
                'set_leader_confirm' => 'Прехвърляне на лидерство на :user?',
                'status' => 'Състояние',
                'title' => 'Текущи членове',
            ],

            'status' => [
                'status_0' => 'Неактивни',
                'status_1' => 'Активни',
            ],
        ],

        'set_leader' => [
            'success' => 'Потребител :user вече е лидер на отбора.',
        ],
    ],

    'part' => [
        'ok' => 'Напусна отбора ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Чат на отбора',
            'destroy' => 'Разпусни отбора',
            'join' => 'Заяви влизане',
            'join_cancel' => 'Отказ от заявката',
            'part' => 'Напускане на отбора',
        ],

        'info' => [
            'created' => 'Учреден',
        ],

        'members' => [
            'members' => 'Членове в отбора',
            'owner' => 'Лидер на отбора',
        ],

        'sections' => [
            'about' => 'Относто нас!',
            'info' => 'Инфо',
            'members' => 'Членове',
        ],

        'statistics' => [
            'empty_slots' => '',
            'first_places' => '',
            'leader' => 'Лидер на отбора',
            'rank' => 'Ранг',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Отборът е създаден.',
    ],
];
