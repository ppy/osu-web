<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Додан корисник у тим.',
        ],
        'destroy' => [
            'ok' => 'Захтев за придруживање тима је отказан.',
        ],
        'reject' => [
            'ok' => 'Одбијен захтев за придруживање тима.',
        ],
        'store' => [
            'ok' => 'Поднет захтев за придруживање тима.',
        ],
    ],

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'Направи Тим',

        'form' => [
            'name_help' => '',
            'short_name_help' => 'Највише до 4 знака.',
            'title' => "Хајде да направимо нови тим",
        ],

        'intro' => [
            'description' => "Играјте заједно са пријатељима; постојећи или нови. Тренутно нисте у тиму. Придружите се постојећем тиму тако што ћете посетити страницу њиховог тима или креирати свој тим са ове странице.",
            'title' => 'Тим!',
        ],
    ],

    'destroy' => [
        'ok' => 'Тим уклоњен.',
    ],

    'edit' => [
        'ok' => 'Подешавања успешно сачувана.',
        'title' => 'Подешавања Тима',

        'description' => [
            'label' => 'Опис',
            'title' => 'Опис Тима',
        ],

        'flag' => [
            'label' => 'Застава Тима',
            'title' => 'Постави Заставу Тима',
        ],

        'header' => [
            'label' => 'Главна Слика',
            'title' => 'Постави Главну Слику',
        ],

        'settings' => [
            'application_help' => 'Да ли дозволити другим људима да се пријаве за придруживање тима',
            'default_ruleset_help' => '',
            'flag_help' => 'Максимална величина од :widthx:height',
            'header_help' => 'Максимална величина од :widthx:height',
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
            'index' => 'управљање члановима',
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
                'accept_confirm' => '',
                'created_at' => 'Захтевано у',
                'empty' => 'Тренутно нема захтева за придруживање.',
                'empty_slots' => 'Број доступних места',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => 'Захтеви за придруживање',
            ],

            'table' => [
                'joined_at' => 'Датум Придруживања',
                'remove' => 'Уклони',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Статус',
                'title' => 'Тренутни чланови',
            ],

            'status' => [
                'status_0' => 'Неактивно',
                'status_1' => 'Активно',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => 'Изашао/ла из тима ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Часкање Тима',
            'destroy' => 'Распусти Тим',
            'join' => 'Захтев за придруживање',
            'join_cancel' => 'Откажи захтев за придруживање',
            'part' => 'Изађи из тима',
        ],

        'info' => [
            'created' => 'Створен',
        ],

        'members' => [
            'members' => 'Чланови Тима',
            'owner' => 'Вођа Тима',
        ],

        'sections' => [
            'about' => 'О Нама!',
            'info' => 'Инфо',
            'members' => 'Чланови',
        ],

        'statistics' => [
            'empty_slots' => '',
            'first_places' => '',
            'leader' => 'Вођа Тима',
            'rank' => 'Ранг',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Тим Направљен.',
    ],
];
