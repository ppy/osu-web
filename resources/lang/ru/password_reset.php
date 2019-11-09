<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

        'support' => [
            '_' => 'Нужна дополнительная помощь? Свяжитесь с нами через :button.',
            'button' => 'система поддержки',
        ],
    ],
];
