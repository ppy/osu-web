<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Указан неверный :attribute.',
    'not_negative' => ':attribute не может быть отрицательным.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'too_long' => ':attribute превышает максимальное количество символов - можно использовать только до :limit characters символов.',
    'wrong_confirmation' => 'Поля не совпадают.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Временная отметка указана, но карта не найдена.',
        'beatmapset_no_hype' => "К карте нельзя применить функции хайпа.",
        'hype_requires_null_beatmap' => 'Хайп может быть применен только в Общей (все сложности) секции.',
        'invalid_beatmap_id' => 'Указана неверная сложность.',
        'invalid_beatmapset_id' => 'Указана неправильная карта.',
        'locked' => 'Обсуждение закрыто.',

        'attributes' => [
            'message_type' => 'Тип сообщения',
            'timestamp' => 'Временная отметка',
        ],

        'hype' => [
            'discussion_locked' => "Данная карта в текущий момент закрыта для обсуждения и не может быть хайпанута",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Обсуждение закрыто.',
        'first_post' => 'Невозможно удалить первый пост.',

        'attributes' => [
            'message' => 'Сообщение',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Нельзя ответить на удалённый комментарий.',
        'top_only' => 'Не допускается закреплять ответы на комментарии.',

        'attributes' => [
            'message' => 'Сообщение',
        ],
    ],

    'follow' => [
        'invalid' => 'Указан неверный :attribute.',
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
            'first_post_no_delete' => 'Невозможно удалить первый пост',
            'missing_topic' => 'Отсутствует тема поста',
            'only_quote' => 'Ваш ответ содержит только цитату.',

            'attributes' => [
                'post_text' => 'Тело сообщения',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Заголовок темы',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Повторение вариантов недопустимо.',
            'grace_period_expired' => 'Нельзя отредактировать опрос спустя более чем :limit часов.',
            'hiding_results_forever' => 'Нельзя скрыть результаты опроса, если он никогда не закончится.',
            'invalid_max_options' => 'Вариант на пользователя не может превышать количество доступных опций.',
            'minimum_one_selection' => 'Требуется минимум один вариант для каждого пользователя.',
            'minimum_two_options' => 'Нужно как минимум два варианта.',
            'too_many_options' => 'Превышено максимальное количество вариантов.',

            'attributes' => [
                'title' => 'Заголовок опроса',
            ],
        ],

        'topic_vote' => [
            'required' => 'Выберите вариант, за который хотите проголосовать.',
            'too_many' => 'Выбрано больше вариантов, чем разрешено.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Превышено максимальное количество приложений OAuth.',
            'url' => 'Пожалуйста, введите действительный URL.',

            'attributes' => [
                'name' => 'Имя приложения',
                'redirect' => 'Callback URL приложения',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Пароль не должен содержать никнейм.',
        'email_already_used' => 'Почта уже использована.',
        'email_not_allowed' => 'Недопустимый адрес электронной почты.',
        'invalid_country' => 'Вашей страны нет в базе данных.',
        'invalid_discord' => 'Неверное имя пользователя Discord.',
        'invalid_email' => "Кажется, эта почта недействительна.",
        'invalid_twitter' => 'Неверное имя пользователя Twitter.',
        'too_short' => 'Новый пароль слишком короткий.',
        'unknown_duplicate' => 'Никнейм или почта уже занята.',
        'username_available_in' => 'Этот никнейм будет доступен через :duration.',
        'username_available_soon' => 'Этот никнейм будет доступен в любой момент!',
        'username_invalid_characters' => 'Выбранный никнейм содержит недопустимые символы.',
        'username_in_use' => 'Этот никнейм уже используется!',
        'username_locked' => 'Этот никнейм уже используется!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Пожалуйста не используйте пробелы и подчёркивания одновременно!',
        'username_no_spaces' => "Никнейм не может начинаться или заканчиваться пробелами!",
        'username_not_allowed' => 'Этот никнейм запрещён.',
        'username_too_short' => 'Выбранный никнейм слишком короткий.',
        'username_too_long' => 'Выбранный никнейм слишком длинный.',
        'weak' => 'Слишком лёгкий пароль.',
        'wrong_current_password' => 'Текущий пароль неверный.',
        'wrong_email_confirmation' => 'Почты не совпадают.',
        'wrong_password_confirmation' => 'Пароли не совпадают.',
        'too_long' => 'Превышено максимальное количество символов - можно использовать только до :limit characters символов.',

        'attributes' => [
            'username' => 'Никнейм',
            'user_email' => 'E-mail адрес',
            'password' => 'Пароль',
        ],

        'change_username' => [
            'restricted' => 'Вы не можете сменить свой никнейм, пока ваш аккаунт ограничен.',
            'supporter_required' => [
                '_' => 'Вы должны :link , чтобы изменить свой никнейм!',
                'link_text' => 'поддержать osu!',
            ],
            'username_is_same' => 'Это уже и есть Ваш никнейм!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'На рейтинговые карты нельзя пожаловаться',
        'reason_not_valid' => ':reason не подходит для данного типа отчета.',
        'self' => "Вы не можете пожаловаться на себя!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Кол-во',
                'cost' => 'Цена',
            ],
        ],
    ],
];
