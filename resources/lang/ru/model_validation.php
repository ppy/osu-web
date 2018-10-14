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
    'not_negative' => ':attribute не может быть отрицательным.',
    'required' => ':attribute является необходимым.',
    'too_long' => ':attribute превышает максимальное количество символов - можно использовать только до :limit characters символов.',
    'wrong_confirmation' => 'Повторы не совпадают.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Обсуждение закрыто.',
        'first_post' => 'Невозможно удалить первую публикацию.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Временная отметка указана, но карта не найдена.',
        'beatmapset_no_hype' => "К карте нельзя применить функции хайпа.",
        'hype_requires_null_beatmap' => 'Хайп может быть применен только в Общей (все сложности) секции.',
        'invalid_beatmap_id' => 'Указана неверная сложность.',
        'invalid_beatmapset_id' => 'Указана неправильная карта.',
        'locked' => 'Обсуждение закрыто.',

        'hype' => [
            'guest' => 'Вам нужно войти, чтобы хайпить.',
            'hyped' => 'Вы уже хайпили на этой карте.',
            'limit_exceeded' => 'Вы уже использовали весь свой хайп.',
            'not_hypeable' => 'Эта карта не может быть расхайплена',
            'owner' => 'Вы не можете хайпить свои карты.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Указанная временная отметка выходит за рамки её длины.',
            'negative' => "Временная отметка не может быть отрицательной.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Можно только проголосовать за запрос функции.',
            'not_enough_feature_votes' => 'Недостаточно голосов.',
        ],

        'poll_vote' => [
            'invalid' => 'Указан недопустимый вариант.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Нельзя удалить метаданные карты.',
            'beatmapset_post_no_edit' => 'Нельзя изменить метаданные карты.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Повторение вариантов недопустимо.',
            'invalid_max_options' => 'Вариант на пользователя не может превышать количество доступных опций.',
            'minimum_one_selection' => 'Требуется минимум один вариант для каждого пользователя.',
            'minimum_two_options' => 'Нужно как минимум два варианта.',
            'too_many_options' => 'Превышено максимальное количество вариантов.',
        ],

        'topic_vote' => [
            'required' => 'Выберите вариант, за который хотите проголосовать.',
            'too_many' => 'Выбрано больше вариантов, чем разрешено.',
        ],
    ],

    'user' => [
        'contains_username' => 'Пароль не должен содержать никнейм.',
        'email_already_used' => 'Почта уже использована.',
        'invalid_country' => 'Вашей страны нет в базе данных.',
        'invalid_discord' => 'Это не похоже на DiscordTag.',
        'invalid_email' => "Это не похоже на адрес электронной почты.",
        'too_short' => 'Новый пароль слишком короткий.',
        'unknown_duplicate' => 'Имя пользователя или почта уже занята.',
        'username_available_in' => 'Это имя будет доступно только спустя :duration.',
        'username_available_soon' => 'Это имя будет доступно для выбора в любую минуту!',
        'username_invalid_characters' => 'Выбранное имя содержит недопустимые символы.',
        'username_in_use' => 'Это имя уже используется!',
        'username_no_space_userscore_mix' => 'Пожалуйста не используйте пробелы и подчёркивания одновременно!',
        'username_no_spaces' => "Имя не может начинаться и заканчиваться пробелами!",
        'username_not_allowed' => 'Это имя недоступно.',
        'username_too_short' => 'Выбранное имя слишком короткое.',
        'username_too_long' => 'Выбранное имя слишком длинное.',
        'weak' => 'Слишком лёгкий пароль.',
        'wrong_current_password' => 'Текущий пароль неверный.',
        'wrong_email_confirmation' => 'Подтверждения почты не совпадают.',
        'wrong_password_confirmation' => 'Подтверждения пароля не совпадают.',
        'too_long' => 'Превышено максимальное количество символов - можно использовать только до :limit characters символов.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Вы должны :link , чтобы изменить свое имя!',
                'link_text' => 'поддержать osu!',
            ],
            'username_is_same' => 'Это имя уже используется!',
        ],
    ],
];
