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
    'not_negative' => ':attribute не може бути від\'ємним.',
    'required' => ':attribute є обов\'язковим.',
    'too_long' => ':attribute перевищує максимальну кількість символів - можна використовувати тільки до :limit символів.',
    'wrong_confirmation' => 'Повтори не збігаються.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Обговорення закрито.',
        'first_post' => 'Неможливо видалити першу публікацію.',

        'attributes' => [
            'message' => '',
        ],
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Часова відмітка вказана, але карту не знайдено.',
        'beatmapset_no_hype' => "До карти не можна застосувати функції хайпу.",
        'hype_requires_null_beatmap' => 'Хайп може бути застосований тільки в Загальній (всі складності) секції.',
        'invalid_beatmap_id' => 'Вказана невірна складність.',
        'invalid_beatmapset_id' => 'Вказана неправильна карта.',
        'locked' => 'Обговорення закрито.',

        'attributes' => [
            'message_type' => '',
            'timestamp' => '',
        ],

        'hype' => [
            'guest' => 'Потрібно ввійти для хайпу.',
            'hyped' => 'Ви вже хайпили цю карту.',
            'limit_exceeded' => 'Ви вже використали весь свій хайп.',
            'not_hypeable' => 'Цей beatmap не може бути хайпнутий',
            'owner' => 'Ви не можете хайпити свої карти.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Зазначена часова мітка виходить за рамки довжини карти.',
            'negative' => "Часова мітка не може бути від'ємною.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Не можна відповісти на видалений коментар.',

        'attributes' => [
            'message' => '',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Ви можете проголосувати лише за запити функцій.',
            'not_enough_feature_votes' => 'Недостатньо голосів.',
        ],

        'poll_vote' => [
            'invalid' => 'Вказано неприпустимий варіант.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Не можна видалити метадані карти.',
            'beatmapset_post_no_edit' => 'Не можна змінити метадані карти.',
            'only_quote' => 'Ваш відповідь містить тільки цитату.',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => '',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Повторення варіантів неприпустимо.',
            'grace_period_expired' => 'Не можна відредагувати опитування через :limit годин.',
            'hiding_results_forever' => 'Не можна приховати результати опитування, якщо він ніколи не закінчиться.',
            'invalid_max_options' => 'Варіант на користувача не може перевищувати кількість доступних опцій.',
            'minimum_one_selection' => 'Потрібен мінімум один варіант для кожного користувача.',
            'minimum_two_options' => 'Потрібно як мінімум два варіанти.',
            'too_many_options' => 'Перевищено максимальну кількість варіантів.',

            'attributes' => [
                'title' => '',
            ],
        ],

        'topic_vote' => [
            'required' => 'Виберіть варіант, за який хочете проголосувати.',
            'too_many' => 'Обрано більше варіантів, ніж дозволено.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Пароль не повинен містити нікнейм.',
        'email_already_used' => 'Дана адреса вже використовується.',
        'invalid_country' => 'Вашої країни немає в базі даних.',
        'invalid_discord' => 'Ім’я користувача Discord недійсне.',
        'invalid_email' => "Це не схоже на адресу електронної пошти.",
        'too_short' => 'Новий пароль надто короткий.',
        'unknown_duplicate' => 'Ім\'я користувача або пошта вже зайнята.',
        'username_available_in' => 'Це ім\'я користувача буде доступним для використання через :duration.',
        'username_available_soon' => 'Це ім\'я користувача буде доступне для вибору в будь-яку хвилину!',
        'username_invalid_characters' => 'Обраний ім\'я містить недопустимі символи.',
        'username_in_use' => 'Це ім\'я вже використовується!',
        'username_locked' => 'Це ім\'я вже використовується!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Будь ласка, не використовуйте пробіли і підкреслення одночасно!',
        'username_no_spaces' => "Ім'я не може починатися і закінчуватися пробілами!",
        'username_not_allowed' => 'Це ім\'я недоступно.',
        'username_too_short' => 'Обране ім\'я надто коротке.',
        'username_too_long' => 'Обраний ім\'я надто довге.',
        'weak' => 'Занадто легкий пароль.',
        'wrong_current_password' => 'Введений пароль невірний.',
        'wrong_email_confirmation' => 'Підтвердження пошти і пошта не збігаються.',
        'wrong_password_confirmation' => 'Підтвердження пароля і пароль не збігаються.',
        'too_long' => 'Перевищує максимальну кількість символів - можна використовувати тільки до :limit символів.',

        'attributes' => [
            'username' => '',
            'user_email' => '',
            'password' => '',
        ],

        'change_username' => [
            'restricted' => 'Ви не можете змінити ім\'я, поки ваш аккаунт обмежено.',
            'supporter_required' => [
                '_' => 'Ви повинні :link для зміни ніку!',
                'link_text' => 'підтримати osu!',
            ],
            'username_is_same' => 'Це ім\'я вже використовується!',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => '',
        'self' => "Ви не можете поскаржитися на себе!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '',
                'cost' => '',
            ],
        ],
    ],
];
