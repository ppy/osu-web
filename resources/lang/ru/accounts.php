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
    'edit' => [
        'title' => 'Настройки <strong>профиля</strong>',
        'title_compact' => 'настройки',

        'avatar' => [
            'title' => 'Аватар',
        ],

        'email' => [
            'current' => 'текущий email',
            'new' => 'новый email',
            'new_confirmation' => 'повтори email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'текущий пароль',
            'new' => 'новый пароль',
            'new_confirmation' => 'повтори пароль',
            'title' => 'Пароль',
        ],

        'profile' => [
            'title' => 'Дополнительная информация',

            'user' => [
                'user_from' => 'проживание',
                'user_msnm' => 'скайп',
                'user_occ' => 'профессия',
                'user_twitter' => 'твиттер',
                'user_website' => 'веб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Подпись',
            'update' => 'обновить',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! подтверждение смены почты',
        'update' => 'изменить',
    ],

    'update_password' => [
        'email_subject' => 'osu! подтверждение нового пароля',
        'update' => 'изменить',
    ],

    'playstyles' => [
        'title' => 'Стиль игры',
        'mouse' => 'на мышке',
        'keyboard' => 'на клавиатуре',
        'tablet' => 'на планшете',
        'touch' => 'на сенсорном экране',
    ],
];
