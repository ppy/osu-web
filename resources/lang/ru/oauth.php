<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Отмена',

    'authorise' => [
        'request' => 'запрашивает разрешение доступа к вашему аккаунту.',
        'scopes_title' => 'Это приложение сможет:',
        'title' => 'Запрос авторизации',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Вы уверены, что хотите отозвать права доступа у этого приложения?',
        'scopes_title' => 'Это приложение может:',
        'owned_by' => 'Владелец: :user',
        'none' => 'Нет приложений',

        'revoked' => [
            'false' => 'Отозвать доступ',
            'true' => 'Права доступа отозваны',
        ],
    ],

    'client' => [
        'id' => 'ID приложения',
        'name' => 'Имя приложения',
        'redirect' => 'Callback URL приложения',
        'reset' => 'Сбросить ключ приложения',
        'reset_failed' => 'Не удалось сбросить ключ приложения',
        'secret' => 'Ключ приложения',

        'secret_visible' => [
            'false' => 'Показать ключ',
            'true' => 'Скрыть ключ',
        ],
    ],

    'new_client' => [
        'header' => 'Регистрация нового приложения OAuth',
        'register' => 'Зарегистрировать',
        'terms_of_use' => [
            '_' => 'Используя API, Вы соглашаетесь с :link.',
            'link' => 'условиями предоставления услуг',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Вы уверены, что хотите удалить это приложение?',
        'confirm_reset' => 'Вы уверены, что хотите сбросить ключ приложения? Это действие приведет к аннулированию всех существующих токенов.',
        'new' => 'Новое приложение OAuth',
        'none' => 'Нет приложений',

        'revoked' => [
            'false' => 'Удалить',
            'true' => 'Удалёно',
        ],
    ],
];
