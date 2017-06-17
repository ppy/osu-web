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
    'required' => ':attribute является необходимым.',
    'wrong_confirmation' => 'Повторы не совпадают.',

    'beatmap_discussion_post' => [
        'first_post' => 'Невозможно удалить первую публикацию.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Можно только проголосовать за запрос функции.',
            'not_enough_feature_votes' => 'Недостаточно голосов.',
        ],

        'poll_vote' => [
            'invalid' => 'Указан недопустимый вариант.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Повторение вариантов недопустимо.',
            'invalid_max_options' => 'Вариант на пользователя не может превышать количество доступных опций.', // wut
            'minimum_one_selection' => 'Требуется минимум один вариант для каждого пользователя.', // wut
            'minimum_two_options' => 'Нужно как минимум два варианта.',
            'too_many_options' => 'Превышено максимальное количество вариантов.',
        ],

        'topic_vote' => [
            'too_many' => 'Выбрано больше вариантов, чем разрешено.',
        ],
    ],

    'user_email' => [
        'invalid' => 'Это не похоже на адрес электронной почты.',
        'already_used' => 'Почта уже использована.',
        'wrong_confirmation' => 'Подтверждения почты не совпадают.',
        'wrong_current_password' => 'Текущий пароль неверный.',
    ],

    'user_password' => [
        'contains_username' => 'Пароль не должен содержать никнейм.',
        'too_short' => 'Новый пароль слишком короткий.',
        'weak' => 'Слишком лёгкий пароль.',
        'wrong_confirmation' => 'Подтверждения пароля не совпадают.',
        'wrong_current_password' => 'Текущий пароль неверный.',
    ],
];
