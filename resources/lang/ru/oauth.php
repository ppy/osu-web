<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Отмена',

    'authorise' => [
        'request' => 'запрашивает разрешения доступа к вашему аккаунту.',
        'scopes_title' => 'Это приложение сможет:',
        'title' => 'Запрос авторизации',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Вы уверены, что хотите отозвать права доступа этого клиента?',
        'scopes_title' => 'Это приложение может:',
        'owned_by' => 'Владелец: :user',
        'none' => 'Нет клиентов',

        'revoked' => [
            'false' => 'Отозвать доступ',
            'true' => 'Права доступа отозваны',
        ],
    ],

    'client' => [
        'id' => 'ID клиента',
        'name' => 'Имя приложения',
        'redirect' => 'Callback URL Приложения',
        'reset' => '',
        'reset_failed' => '',
        'secret' => 'Секрет клиента',

        'secret_visible' => [
            'false' => '',
            'true' => '',
        ],
    ],

    'new_client' => [
        'header' => 'Зарегистрируйте новое приложение OAuth',
        'register' => 'Зарегистрировать',
        'terms_of_use' => [
            '_' => 'Используя API, вы соглашаетесь с :link.',
            'link' => 'условиями использования',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Вы уверены, что хотите удалить этого клиента?',
        'confirm_reset' => '',
        'new' => 'Новое приложение OAuth',
        'none' => 'Нет клиентов',

        'revoked' => [
            'false' => 'Удалить',
            'true' => 'Удалён',
        ],
    ],
];
