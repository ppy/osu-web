<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'cancel' => 'Отмена',

    'authorise' => [
        'authorise' => 'Авторизация',
        'request' => 'запрашивает разрешения доступа к вашему аккаунту.',
        'scopes_title' => 'Это приложение сможет:',
        'title' => 'Запрос авторизации',

        'wrong_user' => [
            '_' => 'Вы вошли как :user. :logout_link.',
            'logout_link' => 'Нажмите здесь, чтобы войти как другой пользователь',
        ],
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Вы уверены, что хотите отозвать права доступа этого клиента?',
        'scopes_title' => 'Это приложение может:',
        'owned_by' => 'Владелец: :user',
        'none' => 'Нет клиентов',

        'revoked' => [
            'false' => 'Отозвать права доступа',
            'true' => 'Права доступа отозваны',
        ],
    ],

    'client' => [
        'id' => 'ID клиента',
        'name' => 'Имя приложения',
        'redirect' => '',
        'secret' => 'Секрет клиента',
    ],

    'login' => [
        'download' => 'Нажмите здесь, чтобы скачать игру и создать аккаунт',
        'label' => 'Для начала, давайте войдём в ваш аккаунт!',
        'title' => 'Вход в аккаунт',
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
        'new' => 'Новое приложение OAuth',
        'none' => 'Нет клиентов',

        'revoked' => [
            'false' => 'Удалить',
            'true' => 'Удалён',
        ],
    ],
];
