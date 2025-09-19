<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Гулец прыняты ў каманду.',
        ],
        'destroy' => [
            'ok' => 'Запыт на ўступленне адкліканы.',
        ],
        'reject' => [
            'ok' => 'Запыт на ўступленне адхілены.',
        ],
        'store' => [
            'ok' => 'Запыт на ўступленне адпраўлены.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited удзельнік|:count_delimited удзельніка|:count_delimited удзельнікаў',
    ],

    'create' => [
        'submit' => 'Стварыць каманду!',

        'form' => [
            'name_help' => 'Назва вашай каманды. Пакуль што яго нельга будзе змяніць.',
            'short_name_help' => 'Максімум 4 знака.',
            'title' => "Прыступім да стварэння новай каманды",
        ],

        'intro' => [
            'description' => "Гуляйце разам з сябрамі, стварыўшы сваю каманду або заводзіце новых, уступаючы ў існуючыя! Пакуль вы не ў камандзе.",
            'title' => 'Каманда!',
        ],
    ],

    'destroy' => [
        'ok' => 'Каманды больш не існуе.',
    ],

    'edit' => [
        'ok' => 'Налады захаваны.',
        'title' => 'Налады каманды',

        'description' => [
            'label' => 'Апісанне',
            'title' => 'Апісанне каманды',
        ],

        'flag' => [
            'label' => 'Сцяг каманды',
            'title' => 'Загрузіць сцяг',
        ],

        'header' => [
            'label' => 'Вокладка',
            'title' => 'Загрузіць вокладку',
        ],

        'settings' => [
            'application_help' => 'Ці дазволіць усім жадаючым падаваць запыты на ўступленне ў каманду',
            'default_ruleset_help' => 'Рэжым гульні, які адлюстроўваецца на галоўнай старонцы каманды',
            'flag_help' => 'Максімальны размер: :width×:height',
            'header_help' => 'Максімальны размер: :width×:height',
            'title' => 'Налады каманды',

            'application_state' => [
                'state_0' => 'Закрыта',
                'state_1' => 'Адкрыта',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'налады',
        'leaderboard' => 'рэйтынг',
        'show' => 'інфармацыя',

        'members' => [
            'index' => 'кіраванне ўдзельнікамі',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Глабальны рэйтынг',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Удзельнік каманды выдалены',
        ],

        'index' => [
            'title' => 'Кіраванне ўдзельнікамі',

            'applications' => [
                'accept_confirm' => 'Прыняць гульца :user ў каманду?',
                'created_at' => 'Запыт адпраўлены',
                'empty' => 'Няма запытаў на ўступленне.',
                'empty_slots' => 'Свабодных месцаў',
                'empty_slots_overflow' => 'перапоўненая на :count_delimited гульца|перапоўненая на :count_delimited гульцоў',
                'reject_confirm' => 'Адхіліць запыт на ўступленне гульца :user?',
                'title' => 'Запыты на ўступленне',
            ],

            'table' => [
                'joined_at' => 'Дата ўступлення',
                'remove' => 'Выдаліць',
                'remove_confirm' => 'Выдаліць гульца :user з каманды?',
                'set_leader' => 'Перадаць правы кіравання',
                'set_leader_confirm' => 'Перадаць тытул капітана каманды гульцу :user?',
                'status' => 'Статус',
                'title' => 'Сучасныя ўдзельнікі',
            ],

            'status' => [
                'status_0' => 'Неактыўны',
                'status_1' => 'Актыўны',
            ],
        ],

        'set_leader' => [
            'success' => 'Цяпер гулец :user - новы капітан каманды.',
        ],
    ],

    'part' => [
        'ok' => 'Вы пакінулі каманду ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Камандны чат',
            'destroy' => 'Распусціць каманду',
            'join' => 'Ўступіць у каманду',
            'join_cancel' => 'Адклікаць запыт',
            'part' => 'Пакінуць каманду',
        ],

        'info' => [
            'created' => 'Сфармаваная',
        ],

        'members' => [
            'members' => 'Удзельнікі каманды',
            'owner' => 'Капітан каманды',
        ],

        'sections' => [
            'about' => 'Пра нас!',
            'info' => 'Інфармацыя',
            'members' => 'Удзельнікі',
        ],

        'statistics' => [
            'empty_slots' => '',
            'leader' => 'Капітан каманды',
            'rank' => 'Ранг',
        ],
    ],

    'store' => [
        'ok' => 'Каманда створана.',
    ],
];
