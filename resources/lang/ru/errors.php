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
    'codes' => [
        'http-401' => 'Войдите для продолжения.',
        'http-403' => 'Доступ запрещён.',
        'http-404' => 'Не найдено.',
        'http-429' => 'Слишком много попыток. Попробуйте позже.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Возникла ошибка. Попробуй перезагрузить страницу.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Указан недопустимый мод.',
        'standard_converts_only' => 'Результатов для запрашиваемого мода нет.',
    ],
    'checkout' => [
        'generic' => 'Произошла ошибка при обработке заказа.',
    ],
    'search' => [
        'default' => 'Ничего не найдено, попробуйте позже.',
        'operation_timeout_exception' => 'Поиск сейчас перегружен, попробуйте позже.',
    ],

    'logged_out' => 'Вы вышли из аккаунта. Пожалуйста войдите и попробуйте ещё раз.',
    'supporter_only' => 'Вы должны иметь osu!supporter для использования этой возможности.',
    'no_restricted_access' => 'Вы не можете использовать данную функцию пока ваши права ограничены.',
    'unknown' => 'Возникла неизвестная ошибка.',
];
