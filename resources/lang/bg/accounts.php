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
    'edit' => [
        'title' => '<strong>Профилни</strong> настройки',
        'title_compact' => 'настройки',
        'username' => 'потребителско име',

        'avatar' => [
            'title' => 'Аватар',
        ],

        'email' => [
            'current' => 'текущ имейл',
            'new' => 'нов имейл',
            'new_confirmation' => 'потвърдете новия имейл',
            'title' => 'Имейл',
        ],

        'password' => [
            'current' => 'текуща парола',
            'new' => 'нова парола',
            'new_confirmation' => 'потвърдете новата парола',
            'title' => 'Парола',
        ],

        'profile' => [
            'title' => 'Профил',

            'user' => [
                'user_from' => 'настоящо местонахождение',
                'user_interests' => 'интереси',
                'user_msnm' => '',
                'user_occ' => 'работа/занимание',
                'user_twitter' => '',
                'user_website' => 'уеб сайт',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Подпис',
            'update' => 'обнови',
        ],
    ],

    'update_email' => [
        'email_subject' => 'потвърдете смяната на osu! имейла',
        'update' => 'обнови',
    ],

    'update_password' => [
        'email_subject' => 'подвърдете смяната на osu! парола',
        'update' => 'обнови',
    ],

    'playstyles' => [
        'title' => 'Стил на игра',
        'mouse' => 'мишка',
        'keyboard' => 'клавиатура',
        'tablet' => 'таблет',
        'touch' => 'тъчскрийн',
    ],

    'privacy' => [
        'title' => 'Поверителност',
        'friends_only' => 'Блокирай лични съобщения от хора с който не си приятел',
        'hide_online' => 'скриване на вашето онлайн присъствие',
    ],

    'security' => [
        'current_session' => 'текущ',
        'end_session' => 'Прекрати сесията',
        'end_session_confirmation' => 'Това непосредствено ще прекрати сесията ви на това устройство. Сигурни ли сте?',
        'last_active' => 'Последно активен:',
        'title' => 'Сигурност',
        'web_sessions' => 'уеб сесии',
    ],
];
