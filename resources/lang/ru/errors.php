<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'load_failed' => 'Не удалось загрузить данные.',
    'missing_route' => 'Неверный url или неправильный метод запроса.',
    'no_restricted_access' => 'У вас нет доступа к этой возможности, поскольку аккаунт находится в ограниченном режиме.',
    'supporter_only' => 'Чтобы использовать эту возможность, у вас должен быть тег osu!supporter.',
    'unknown' => 'Произошла неизвестная ошибка.',

    'codes' => [
        'http-401' => 'Войдите в свой аккаунт.',
        'http-403' => 'Доступ запрещён.',
        'http-404' => 'Не найдено.',
        'http-429' => 'Слишком много попыток. Попробуйте позже.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Произошла ошибка. Попробуйте перезагрузить страницу.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Задан недопустимый режим.',
        'standard_converts_only' => 'На данной сложности нет рекордов, поставленных в выбранном режиме.',
    ],
    'checkout' => [
        'generic' => 'При обработке заказа произошла ошибка.',
    ],
    'search' => [
        'default' => 'Ничего не найдено, попробуйте позже.',
        'invalid_cursor_exception' => 'Задан неверный параметр курсора.',
        'operation_timeout_exception' => 'Поиск сейчас перегружен, попробуйте позже.',
    ],
];
