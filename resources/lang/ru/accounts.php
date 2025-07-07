<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'настройки',
        'username' => 'ник',

        'avatar' => [
            'title' => 'Аватар',
            'reset' => 'удалить',
            'rules' => 'Убедитесь, что ваш аватар соответствует :link.<br/>Это означает, что он обязан <strong>подходить для всех возрастов</strong>, т.е. не должен содержать наготы, ненормативной лексики или вызывающего контента.',
            'rules_link' => 'критериям визуального содержания',
        ],

        'email' => [
            'new' => 'новая почта',
            'new_confirmation' => 'повторите почту',
            'title' => 'Смена почты',
            'locked' => [
                '_' => 'Напишите в :accounts, если хотите изменить адрес электронной почты.',
                'accounts' => 'службу поддержки',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Устаревший API',
        ],

        'password' => [
            'current' => 'текущий пароль',
            'new' => 'новый пароль',
            'new_confirmation' => 'повторите пароль',
            'title' => 'Смена пароля',
        ],

        'profile' => [
            'country' => 'страна',
            'title' => 'Профиль',

            'country_change' => [
                '_' => "Похоже, что страна аккаунта не совпадает с местом вашего проживания. :update_link.",
                'update_link' => 'Сменить на :country',
            ],

            'user' => [
                'user_discord' => 'дискорд',
                'user_from' => 'место проживания',
                'user_interests' => 'интересы',
                'user_occ' => 'род деятельности',
                'user_twitter' => 'твиттер',
                'user_website' => 'веб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Подпись на форуме',
            'update' => 'сохранить',
        ],
    ],

    'github_user' => [
        'info' => "Если вы вносите вклад в репозиторий osu!, подключение аккаунта GitHub позволит связать ваш ник в списке изменений с профилем osu!. Аккаунт GitHub без какого-либо вклада в osu! подключить нельзя.",
        'link' => 'Подключить аккаунт GitHub',
        'title' => 'GitHub',
        'unlink' => 'Отключить аккаунт GitHub',

        'error' => [
            'already_linked' => 'Этот аккаунт GitHub уже связан с другим пользователем.',
            'no_contribution' => 'Нельзя подключить аккаунт GitHub без вклада в репозиторий osu!.',
            'unverified_email' => 'Пожалуйста, сначала подтвердите электронную почту аккаунта GitHub, затем попробуйте снова.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'получать уведомления о новых проблемах с квалифицированными картами у следующих режимов',
        'beatmapset_disqualify' => 'получать уведомления о дисквалификации карт у следующих режимов',
        'comment_reply' => 'получать уведомления об ответах на мои комментарии',
        'title' => 'Уведомления',
        'topic_auto_subscribe' => 'всегда подписываться на уведомления в новых темах на форуме, которые я создаю или в которых мне отвечают',

        'options' => [
            '_' => 'способы получения',
            'beatmap_owner_change' => 'о гостевых сложностях',
            'beatmapset:modding' => 'о новых модах',
            'channel_message' => 'о новых личных сообщениях',
            'channel_team' => 'о сообщениях в командном чате',
            'comment_new' => 'о новых комментариях',
            'forum_topic_reply' => 'об ответах на форуме',
            'mail' => 'почта',
            'mapping' => 'о действиях мапперов',
            'push' => 'пуши',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'подключенные приложения
',
        'own_clients' => 'мои приложения',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'скрыть предупреждения об откровенном содержании в картах',
        'beatmapset_title_show_original' => 'показывать метаданные карт на языке оригинала',
        'title' => 'Веб-сайт',

        'beatmapset_download' => [
            '_' => 'по умолчанию скачивать карты',
            'all' => 'с видео (если есть)',
            'direct' => 'через osu!direct',
            'no_video' => 'без видео',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'клавиатура',
        'mouse' => 'мышь',
        'tablet' => 'графический планшет',
        'title' => 'Устройства',
        'touch' => 'сенсорный экран',
    ],

    'privacy' => [
        'friends_only' => 'блокировать личные сообщения не от друзей',
        'hide_online' => 'скрывать, что я в сети',
        'title' => 'Конфиденциальность',
    ],

    'security' => [
        'current_session' => 'текущая',
        'end_session' => 'Завершить',
        'end_session_confirmation' => 'Сеанс на этом устройстве будет немедленно завершён. Вы уверены?',
        'last_active' => 'Последняя активность:',
        'title' => 'Безопасность',
        'web_sessions' => 'веб-сессии',
    ],

    'update_email' => [
        'update' => 'сохранить',
    ],

    'update_password' => [
        'update' => 'сохранить',
    ],

    'verification_completed' => [
        'text' => 'Эту вкладку можно закрыть',
        'title' => 'Проверка завершена',
    ],

    'verification_invalid' => [
        'title' => 'Неверная или устаревшая ссылка для подтверждения',
    ],
];
