<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Скасаваць',

    'authorise' => [
        'request' => 'запытваецца дазвол да вашага ўліковага запісу.',
        'scopes_title' => 'Гэта праграма будзе мець магчымасць:',
        'title' => 'Запыт аўтарызацыі',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Вы ўпэўнены, што хочаце адклікаць дазволення доступу гэтага кліента?',
        'scopes_title' => 'Гэта праграма можа:',
        'owned_by' => 'Уладальнік: :user',
        'none' => 'Няма кліентаў',

        'revoked' => [
            'false' => 'Адклікаць доступ',
            'true' => 'Доступ адкліканы',
        ],
    ],

    'client' => [
        'id' => 'ID кліента',
        'name' => 'Назва праграмы',
        'redirect' => 'Callback URL Прыкладання',
        'reset' => 'Скінуць кліенцкую таямніцу',
        'reset_failed' => 'Не ўдалося скінуць пароль кліента',
        'secret' => 'Кліенцкая таямніца',

        'secret_visible' => [
            'false' => 'Паказаць кліенцкую таямніцу',
            'true' => 'Схаваць кліенцкую таямніцу',
        ],
    ],

    'new_client' => [
        'header' => 'Зарэгіструйце новае прыкладанне OAuth',
        'register' => 'Зарэгістраваць прыкладанне',
        'terms_of_use' => [
            '_' => 'Выкарыстоўваючы API, вы згаджаецеся з :link.',
            'link' => 'Умовы выкарыстання',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Вы сапраўды жадаеце выдаліць гэты кліент?',
        'confirm_reset' => 'Вы ўпэўнены, што хочаце скінуць кліенцкую таямніцу? Гэта адменіць усе існуючыя токены.',
        'new' => 'Новае прыкладанне OAuth',
        'none' => 'Няма кліентаў',

        'revoked' => [
            'false' => 'Выдаліць',
            'true' => 'Выдалена',
        ],
    ],
];
