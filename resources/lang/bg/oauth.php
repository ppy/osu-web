<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Отмени',

    'authorise' => [
        'request' => 'иска разрешение за достъп до вашия акаунт.',
        'scopes_title' => 'Това приложение ще може да:',
        'title' => 'Искане за оторизация',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Сигурни ли сте, че искате да отмените правата на този клиент?',
        'scopes_title' => 'Това приложение има право да:',
        'owned_by' => 'Притежавано от :user',
        'none' => 'Няма клиенти',

        'revoked' => [
            'false' => 'Отнемане на достъпa',
            'true' => 'Достъпът отнет',
        ],
    ],

    'client' => [
        'id' => 'ID на клиента',
        'name' => 'Име на приложението',
        'redirect' => 'Callback URL на приложението',
        'reset' => 'Рестартиране на тайната на клиента',
        'reset_failed' => 'Неуспешно рестартиране на тайната на клиента',
        'secret' => 'Тайна на клиента',

        'secret_visible' => [
            'false' => 'Покажи тайната на клиента',
            'true' => 'Скрий тайната на клиента',
        ],
    ],

    'new_client' => [
        'header' => 'Регистрирането на ново OAuth приложение',
        'register' => 'Регистриране на приложение',
        'terms_of_use' => [
            '_' => 'С ползването на този API, Вие се съгласявате на :link.',
            'link' => 'Условия за ползване',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Сигурни ли сте, че искате да изтриете този клиент?',
        'confirm_reset' => 'Сигурни ли сте, че искате да рестартирате тайната на клиента? Това ще анулира всички съществуващи токени.',
        'new' => 'Ново OAuth приложение',
        'none' => 'Няма клиенти',

        'revoked' => [
            'false' => 'Изтрий',
            'true' => 'Изтрито',
        ],
    ],
];
