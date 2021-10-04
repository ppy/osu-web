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
            'false' => 'Отмени Достъпа',
            'true' => 'Достъпът Отменен',
        ],
    ],

    'client' => [
        'id' => 'Клиент ID',
        'name' => 'Име на приложение',
        'redirect' => 'Callback URL на приложение',
        'reset' => 'Занули тайната на клиент',
        'reset_failed' => 'Неуспешно занулена тайна на клиент',
        'secret' => 'Тайна на клиент',

        'secret_visible' => [
            'false' => 'Покажи тайната на клиент',
            'true' => 'Скрий тайната на клиент',
        ],
    ],

    'new_client' => [
        'header' => 'Регистрирането на ново OAuth приложение',
        'register' => 'Регистриране на приложение',
        'terms_of_use' => [
            '_' => 'При използването на този API, се съгласявате с :link.',
            'link' => 'Условията за Ползване',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Сигурни ли сте, че искате да изтриете този клиент?',
        'confirm_reset' => 'Сигурни ли сте, че искате да занулите тайната на клиента? Това ще анулира всички съществуващи токени.',
        'new' => 'Ново OAuth приложение',
        'none' => 'Няма клиенти',

        'revoked' => [
            'false' => 'Изтриване',
            'true' => 'Изтрито',
        ],
    ],
];
