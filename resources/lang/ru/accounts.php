<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'title' => 'Настройки <strong>аккаунта</strong>',
        'title_compact' => 'настройки',

        'avatar' => [
            'title' => 'Смена аватара', // Base text changed, please check.
        ],

        'email' => [
            'current' => 'текущая почта',
            'new' => 'новая почта',
            'new_confirmation' => 'напишите ещё раз',
            'title' => 'Смена почты',
        ],

        'password' => [
            'current' => 'текущий пароль',
            'new' => 'новый пароль',
            'new_confirmation' => 'напишите ещё раз',
            'title' => 'Смена пароля',
        ],

        'profile' => [
            'title' => 'Дополнительная информация', // Base text changed, please check.

            'user' => [
                'user_from' => 'проживание',
                'user_interests' => 'интересы',
                'user_msnm' => 'skype',
                'user_occ' => 'профессия',
                'user_twitter' => 'twitter',
                'user_website' => 'веб-сайт',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Подпись на форуме',
            'update' => 'сохранить',
        ],
    ],

    'update_email' => [
        'email_subject' => 'Подтверждение смены почты аккаунта osu!',
        'update' => 'сменить',
    ],

    'update_password' => [
        'email_subject' => 'Подтверждение смены пароля аккаунта osu!',
        'update' => 'сменить',
    ],

    'playstyles' => [
        'title' => 'Устройства',
        'mouse' => 'мышка',
        'keyboard' => 'клавиатура',
        'tablet' => 'планшет',
        'touch' => 'сенсорный экран',
    ],
];
