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
    'deleted' => '[удалённый пользователь]',

    'login' => [
        '_' => 'Войти',
        'locked_ip' => 'Ваш IP адрес заблокирован. Попробуйте ещё раз через несколько минут.',
        'username' => 'Никнейм',
        'password' => 'Пароль',
        'button' => 'Войти',
        'remember' => 'Запомнить этот браузер',
        'title' => 'Пожалуйста войдите для продолжения',
        'failed' => 'Неверный никнейм',
        'register' => "У Вас нет аккаунта в osu!? Создайте один",
        'forgot' => 'Забыли свой пароль?',
        'beta' => [
            'main' => 'Доступ к бета-версии доступен привилегированными пользователями.',
            'small' => '(саппортеры получат доступ позже)',
        ],

        'here' => 'тут', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Зарегистрироваться',
    ],
    'anonymous' => [
        'login_link' => 'нажмите для входа',
        'username' => 'Гость',
        'error' => 'Вы должны быть авторизированным, чтобы сделать это.',
    ],
    'logout_confirm' => 'Вы действительно хотите выйти? :(',
    'show' => [
        '404' => 'Пользователь не найден! ;_;',
        'age' => ':age лет',
        'current_location' => 'Проживает в :location',
        'first_members' => 'Зарегистрирован тут с самого начала',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Зарегистрировался :date',
        'lastvisit' => 'В последний раз замечен :date',
        'missingtext' => 'Возможно, Вы сделали опечатку! (или может пользователь забанен)',
        'origin_age' => ':age',
        'origin_country' => 'Из :country',
        'origin_country_age' => ':age из :country',
        'page_description' => 'osu! - Всё, что вы хотели знать про :username!',
        'plays_with' => 'Играет с :devices',
        'title' => "Профиль :username",

        'edit' => [
            'cover' => [
                'button' => 'Сменить обложку профиля',
                'defaults_info' => 'Больше вариантов в недалеком будущем',
                'upload' => [
                    'broken_file' => 'Не удалось установить обложку. Перепроверьте загруженную картинку и попробуйте ещё раз.',
                    'button' => 'Загрузить изображение',
                ],
            ],
        ],
    ],
];
