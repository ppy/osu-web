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
    'title' => 'Сброс пароля',

    'button' => [
        'cancel' => 'Отменить процесс',
        'resend' => 'Переотправить письмо с подтверждением',
        'set' => 'Сохранить пароль',
        'start' => 'Начать процесс',
    ],

    'email' => [
        'subject' => 'Восстановления доступа к аккаунту osu!',
    ],

    'error' => [
        'contact_support' => 'Свяжитесь с поддержкой для восстановления аккаунта.',
        'is_privileged' => 'Пиши peppy кек.',
        'missing_key' => 'Это поле необходимо.',
        'too_many_tries' => 'Слишком много неудачных попыток.',
        'user_not_found' => 'Указанный пользователь не существует.',
        'wrong_key' => 'Неверный код.',
    ],

    'notice' => [
        'sent' => 'Проверьте свою почту для подтверждения.',
        'saved' => 'Новый пароль сохранён!',
    ],

    'started' => [
        'password' => 'Новый пароль',
        'password_confirmation' => 'Повторите новый пароль',
        'title' => 'Восстановление доступа к аккаунту <strong>:username</strong>.',
        'verification_key' => 'Код подтверждения',
    ],

    'starting' => [
        'username' => 'Введите почту или никнейм',
    ],
];
