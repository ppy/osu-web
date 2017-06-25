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
    'title' => 'Восстановление пароля',

    'button' => [
        'cancel' => 'Отмена',
        'resend' => 'Отправить письмо заново',
        'set' => 'Установить пароль',
        'start' => 'Начать',
    ],

    'email' => [
        'subject' => 'osu! восстановление аккаунта',
    ],

    'error' => [
        'contact_support' => 'Просим связаться с поддержкой для восстановления пароля.',
        'is_privileged' => 'Свяжись с peppy кек.',
        'missing_key' => 'Обязательно.',
        'too_many_tries' => 'Слишком много попыток.',
        'user_not_found' => 'Запрошенный пользователь не найден.',
        'wrong_key' => 'Неверный код.',
    ],

    'notice' => [
        'sent' => 'Проверь свою почту для кода подтверждения.',
        'saved' => 'Новый пароль установлен!',
    ],

    'started' => [
        'password' => 'Новый пароль',
        'password_confirmation' => 'Повтори пароль',
        'title' => 'Сброс пароля для <strong>:username</strong>.',
        'verification_key' => 'Ключ подтверждения',
    ],

    'starting' => [
        'username' => 'Введи почту или никнейм',
    ],
];
