<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'authorizations' => [
        'update' => [
            'null_user' => 'Авторизируйтесь для редактирования.',
            'system_generated' => 'Системное сообщение не может быть изменено.',
            'wrong_user' => 'Вы не можете редактировать это сообщение.',
        ],
    ],

    'nearby_posts' => [
        'confirm' => 'Ни один из постов не отвечает моим требованиям', // help
        'notice' => 'Есть новые сообщения :timestamp (:existing_timestamps). Пожалуйста, проверьте их перед публикацией.', // help
    ],

    'reply' => [
        'open' => [
            'guest' => 'Войдите чтобы ответить',
            'user' => 'Ответить',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Отмечено решённым пользователем:user',
            'false' => 'Вновь открыто пользователем :user',
        ],
    ],

    'user' => [
        'admin' => 'администратор',
        'bng' => 'номинатор',
        'owner' => 'маппер',
        'qat' => 'qat', // help
    ],
];
