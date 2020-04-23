<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'настройки',
        'username' => 'имя пользователя',

        'avatar' => [
            'title' => 'Аватар',
            'rules' => 'Пожалуйста, убедитесь, что ваш аватар придерживается :link.<br/>Это значит, что он должен <strong>подходить для всех возрастов</strong>, т.е.: никакой наготы, ругательств или вызывающего контента.',
            'rules_link' => 'правил сообщества',
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
                'user_discord' => 'discord',
                'user_from' => 'место проживания',
                'user_interests' => 'интересы',
                'user_msnm' => 'skype',
                'user_occ' => 'род деятельности',
                'user_twitter' => 'twitter',
                'user_website' => 'веб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Подпись на форуме',
            'update' => 'сохранить',
        ],
    ],

    'notifications' => [
        'title' => 'Уведомления',
        'topic_auto_subscribe' => 'отслеживать созданные темы автоматически',
        'beatmapset_discussion_qualified_problem' => 'получать уведомления о новых проблемах с квалифицированными картами у следующих режимов',

        'mail' => [
            '_' => 'получать уведомления по почте о',
            'beatmapset:modding' => 'моддинге карт',
            'forum_topic_reply' => 'ответах на темы',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'подключенные',
        'own_clients' => 'мои клиенты',
        'title' => 'Приложения и доступ',
    ],

    'options' => [
        'title' => '',

        'beatmapset_download' => [
            '_' => '',
            'all' => '',
            'no_video' => '',
            'direct' => '',
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
        'friends_only' => 'разрешить писать мне только друзьям',
        'hide_online' => 'скрывать онлайн на сайте',
        'title' => 'Конфиденциальность',
    ],

    'security' => [
        'current_session' => 'текущая',
        'end_session' => 'деавторизовать',
        'end_session_confirmation' => 'Сеанс на этом устройстве будет немедленно завершён. Вы уверены?',
        'last_active' => 'Был активен:',
        'title' => 'Безопасность',
        'web_sessions' => 'последняя активность',
    ],

    'update_email' => [
        'update' => 'сменить',
    ],

    'update_password' => [
        'update' => 'сменить',
    ],

    'verification_completed' => [
        'text' => 'Теперь вы можете закрыть эту вкладку/окно',
        'title' => 'Проверка завершена',
    ],

    'verification_invalid' => [
        'title' => 'Неверная или устаревшая ссылка для подтверждения',
    ],
];
