<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'edit' => [
        'title' => 'Настройки <strong>аккаунта</strong>',
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
            'new_confirmation' => 'напишите ещё раз',
            'title' => 'Смена почты',
        ],

        'password' => [
            'current' => 'текущий пароль',
            'new' => 'новый пароль',
            'new_confirmation' => 'напишите ещё раз',
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
        'topic_auto_subscribe' => 'автоматически включать уведомления для тем на форуме, когда вы их создаёте',
        'beatmapset_discussion_qualified_problem' => '',
    ],

    'oauth' => [
        'authorized_clients' => 'авторизованные клиенты',
        'own_clients' => 'мои клиенты',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'клавиатура',
        'mouse' => 'мышь',
        'tablet' => 'графический планшет',
        'title' => 'Устройства',
        'touch' => 'сенсорный экран',
    ],

    'privacy' => [
        'friends_only' => 'блокировать личные сообщения от людей, не входящих в мой список друзей',
        'hide_online' => 'скрыть ваше присутствие',
        'title' => 'Приватность',
    ],

    'security' => [
        'current_session' => 'это вы',
        'end_session' => 'Закончить сеанс',
        'end_session_confirmation' => 'Сеанс на этом устройстве будет немедленно завершён. Вы уверены?',
        'last_active' => 'Был активен:',
        'title' => 'Безопасность',
        'web_sessions' => 'последняя активность',
    ],

    'update_email' => [
        'email_subject' => 'Подтверждение смены почты аккаунта osu!',
        'update' => 'сменить',
    ],

    'update_password' => [
        'email_subject' => 'Подтверждение смены пароля аккаунта osu!',
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
