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
        'secret' => 'Секрет клиента',
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
