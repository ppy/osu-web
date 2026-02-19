<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'button' => [
        'resend' => 'Поново пошаљи верификациони е-маил',
        'set' => 'Постави лозинку',
        'start' => 'Започни',
    ],

    'error' => [
        'contact_support' => 'Молимо вас да контактирате подршку да би сте повратили налог.',
        'expired' => 'Верификациони код је истекао.',
        'invalid' => 'Неочекивана грешка у верификационом коду.',
        'is_privileged' => 'Молимо вас да контактирате админа да би сте повратили налог.',
        'missing_key' => 'Обавезно.',
        'too_many_requests' => '',
        'too_many_tries' => 'Превише неуспелих покушаја уноса.',
        'user_not_found' => 'Овај корисник не постоји.',
        'wait_resend' => '',
        'wrong_key' => 'Неисправан код.',
    ],

    'notice' => [
        'sent' => 'Потражите код за верификацију у вашем имејлу.',
        'saved' => 'Нова лозинка је сачувана!',
    ],

    'started' => [
        'password' => 'Нова лозинка',
        'password_confirmation' => 'Потврда лозинке',
        'title' => 'Ресетовање шифре за налог <strong>:username</strong>.',
        'verification_key' => 'Верификациони код',
    ],

    'starting' => [
        'username' => 'Унесите адресу е-поште или корисничко име',

        'reason' => [
            'inactive_different_country' => "Ваш налог није коришћен дуго времена. Да бисте осигурали безбедност Вашег налога, ресетујте лозинку.",
        ],
        'support' => [
            '_' => 'Треба Вам додатна помоћ? Ступите у контакт преко нашег :button.',
            'button' => 'систем за подршку',
        ],
    ],
];
