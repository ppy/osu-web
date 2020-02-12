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
    'edit' => [
        'title_compact' => 'налаштування',
        'username' => 'ім\'я користувача',

        'avatar' => [
            'title' => 'Аватар',
            'rules' => 'Будь ласка, переконайтеся в тому, що аватар відповідає :link.<br/>Це означає, що він повинен підходити людям <strong>будь-якого віку</strong>. Тобто, не містити наготу, нецензурну лексику та непристойні матеріали.',
            'rules_link' => 'правила спільноти',
        ],

        'email' => [
            'current' => 'поточна електронна адреса',
            'new' => 'нова адреса',
            'new_confirmation' => 'підтвердження адреси',
            'title' => 'Ел. пошта',
        ],

        'password' => [
            'current' => 'поточний пароль',
            'new' => 'новий пароль',
            'new_confirmation' => 'підтвердження паролю',
            'title' => 'Пароль',
        ],

        'profile' => [
            'title' => 'Профіль',

            'user' => [
                'user_discord' => '',
                'user_from' => 'місце проживання',
                'user_interests' => 'інтереси',
                'user_msnm' => '',
                'user_occ' => 'рід занять',
                'user_twitter' => '',
                'user_website' => 'веб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Підпис на форумі',
            'update' => 'оновити',
        ],
    ],

    'notifications' => [
        'title' => 'Сповіщення',
        'topic_auto_subscribe' => 'автоматично вмикати сповіщення для тем на форумі, коли ви їх створюєте',
        'beatmapset_discussion_qualified_problem' => 'отримувати повідомлення про нові проблеми кваліфікованих карт для наступних режимів',

        'mail' => [
            '_' => 'отримувати повідомлення поштою про',
            'beatmapset:modding' => 'моддінг карт',
            'forum_topic_reply' => 'відповідь в темі',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'авторизовані клієнти',
        'own_clients' => 'свої клієнти',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'клавіатура',
        'mouse' => 'мишка',
        'tablet' => 'графічний планшет',
        'title' => 'Пристрої для гри',
        'touch' => 'сенсорний екран',
    ],

    'privacy' => [
        'friends_only' => 'заблокувати приватні повідомлення для людей які не є у моєму списку друзів',
        'hide_online' => 'сховати вашу присутність',
        'title' => 'Політика конфіденційності',
    ],

    'security' => [
        'current_session' => 'поточна',
        'end_session' => 'Завершити сеанс',
        'end_session_confirmation' => 'Сеанс на цьому пристрої буде негайно завершено. Ви впевнені?',
        'last_active' => 'Остання активність:',
        'title' => 'Безпека',
        'web_sessions' => 'веб-сеанси',
    ],

    'update_email' => [
        'update' => 'оновити',
    ],

    'update_password' => [
        'update' => 'оновити',
    ],

    'verification_completed' => [
        'text' => 'Тепер ви можете закрити цю вкладку/вікно',
        'title' => 'Перевірка завершена',
    ],

    'verification_invalid' => [
        'title' => 'Неправильна або застаріла посилання для підтвердження',
    ],
];
