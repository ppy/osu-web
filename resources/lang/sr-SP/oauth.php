<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Откажите',

    'authorise' => [
        'request' => 'захтева дозволу да приступи Вашем налогу.',
        'scopes_title' => 'Ова апликација ће моћи да:',
        'title' => 'Захтев за ауторизацију',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Да ли сте сигурни да желите да уклоните дозволе овом клијенту?',
        'scopes_title' => 'Ова апликација може да:',
        'owned_by' => 'Власник је :user',
        'none' => 'Нема клијента',

        'revoked' => [
            'false' => 'Опозови Приступ',
            'true' => 'Приступ опозван',
        ],
    ],

    'client' => [
        'id' => 'ИД клијента',
        'name' => 'Име Апликације',
        'redirect' => 'Callback URL апликације',
        'reset' => 'Ресетуј тајну клијента',
        'reset_failed' => 'Неуспешан покушај ресетовања тајне клијента',
        'secret' => 'Тајна клијента',

        'secret_visible' => [
            'false' => 'Покажи тајну клијента',
            'true' => 'Сакријте тајну клијента',
        ],
    ],

    'new_client' => [
        'header' => 'Региструјте нову OAuth апликацију',
        'register' => 'Региструјте апликацију',
        'terms_of_use' => [
            '_' => 'Коришћењем API слажете се за :link.',
            'link' => 'Услови коришћења',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Да ли сте сигурни да желите обрисати клијента?',
        'confirm_reset' => 'Да ли сте сигурни да желите да ресетујете тајну клијента? Ово ће опозвати све тренутне токене.',
        'new' => 'Нова OAuth апликација',
        'none' => 'Нема клијента',

        'revoked' => [
            'false' => 'Обришите',
            'true' => 'Обрисано',
        ],
    ],
];
