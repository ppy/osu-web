<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
