<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'настройки аккаунта',
        'username' => 'никнейм',

        'avatar' => [
            'title' => 'Аватар',
            'rules' => 'Пожалуйста, убедитесь, что ваш аватар соответствует :link.<br/>Это означает, что он обязан <strong>подходить для всех возрастов</strong>, т.е. не должен содержать наготы, ругательств или вызывающего контента.',
            'rules_link' => 'правилам сообщества',
        ],

        'email' => [
            'current' => 'текущая почта',
            'new' => 'новая почта',
            'new_confirmation' => 'повторите почту',
            'title' => 'Смена почты',
        ],

        'password' => [
            'current' => 'текущий пароль',
            'new' => 'новый пароль',
            'new_confirmation' => 'повторите пароль',
            'title' => 'Смена пароля',
        ],

        'profile' => [
            'title' => 'Профиль',

            'user' => [
                'user_discord' => '',
                'user_from' => 'место проживания',
                'user_interests' => 'интересы',
                'user_occ' => 'род деятельности',
                'user_twitter' => '',
                'user_website' => 'веб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Подпись на форуме',
            'update' => 'сохранить',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'получать уведомления о новых проблемах с квалифицированными картами у следующих режимов',
        'beatmapset_disqualify' => 'получать уведомления, когда карты для следующих режимов будут дисквалифицированы',
        'comment_reply' => 'следить за ответами на мои комментарии',
        'title' => 'Уведомления',
        'topic_auto_subscribe' => 'следить за темами на форуме, которые я создаю',

        'options' => [
            '_' => 'способы получения',
            'beatmap_owner_change' => 'гостевая сложность',
            'beatmapset:modding' => 'новые моды',
            'channel_message' => 'личные сообщения',
            'comment_new' => 'новые комментарии',
            'forum_topic_reply' => 'ответы на форуме',
            'mail' => 'почта',
            'mapping' => 'замапанные карты',
            'push' => 'пуши',
            'user_achievement_unlock' => 'новые медали',
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
        'friends_only' => 'блокировать сообщения не от друзей',
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
        'title' => 'Неверная или истёкшая ссылка для подтверждения',
    ],
];
