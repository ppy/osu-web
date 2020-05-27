<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Відмінити',

    'authorise' => [
        'request' => 'запитує дозволу доступу до вашого профілю.',
        'scopes_title' => 'Цей додаток матиме змогу:',
        'title' => 'Запит авторизації',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Ви впевнені, що хочете відкликати права доступу цього клієнта?',
        'scopes_title' => 'Цей додаток може:',
        'owned_by' => 'Власник: :user',
        'none' => 'Немає клієнтів',

        'revoked' => [
            'false' => 'Відкликати доступ',
            'true' => 'Доступ заборонено',
        ],
    ],

    'client' => [
        'id' => 'ID клієнта',
        'name' => 'Назва програми',
        'redirect' => 'Callback URL програми',
        'reset' => 'Скинути секрет клієнта',
        'reset_failed' => 'Не вдалося скинути секрет клієнта',
        'secret' => 'Секретний ключ',

        'secret_visible' => [
            'false' => 'Показати секрет клієнта',
            'true' => 'Приховати секрет клієнта',
        ],
    ],

    'new_client' => [
        'header' => 'Зареєструйте новий додаток OAuth',
        'register' => 'Зареєструвати додаток',
        'terms_of_use' => [
            '_' => 'Використовуючи API, ви погоджуєтеся з :link.',
            'link' => 'Умови використання',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Ви впевнені, що хочете видалити цього клієнта?',
        'confirm_reset' => 'Ви впевнені що хочете скинути секрет клієнта? Це скасує всі токени.',
        'new' => 'Нова програма OAuth',
        'none' => 'Немає клієнтів',

        'revoked' => [
            'false' => 'Видалити',
            'true' => 'Видалено',
        ],
    ],
];
