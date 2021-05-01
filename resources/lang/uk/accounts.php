<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'налаштування',
        'username' => 'ім\'я користувача',

        'avatar' => [
            'title' => 'Аватар',
            'rules' => 'Будь ласка, переконайтеся в тому, що Ваш аватар відповідає :link.<br/>Це означає, що він повинен підходити людям <strong>будь-якого віку</strong>. Тобто: не містити наготу, нецензурну лексику та непристойні матеріали.',
            'rules_link' => 'правила спільноти',
        ],

        'email' => [
            'current' => 'поточна  е-адреса',
            'new' => 'нова е-адреса',
            'new_confirmation' => 'підтвердження е-адреси',
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
                'user_from' => 'місце поточного проживання',
                'user_interests' => 'інтереси',
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
        'beatmapset_discussion_qualified_problem' => 'отримувати повідомлення про нові проблеми кваліфікованих карт для наступних режимів',
        'beatmapset_disqualify' => 'отримувати повідомлення коли карти наступних модов дискваліфіковані',
        'comment_reply' => 'отримувати повідомлення про відповіді на ваші коментарі',
        'title' => 'Сповіщення',
        'topic_auto_subscribe' => 'автоматично вмикати сповіщення для нових тем на форумі, коли ви їх створюєте',

        'options' => [
            '_' => 'способи доставки',
            'beatmapset:modding' => 'моддінг карт',
            'channel_message' => 'приватні повідомлення',
            'comment_new' => 'нові коментарі',
            'forum_topic_reply' => 'відповідь темі',
            'mail' => 'пошта',
            'mapping' => 'Маппер біткарти',
            'push' => 'push',
            'user_achievement_unlock' => 'медаль користувача розблоковано',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'авторизовані клієнти',
        'own_clients' => 'власні клієнти',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'Приховати попередження щодо явного вмісту в біткартах',
        'beatmapset_title_show_original' => 'Показувати метадані мовою оригіналу',
        'title' => 'Налаштування',

        'beatmapset_download' => [
            '_' => 'стандартний тип скачування карти',
            'all' => 'з відео, якщо доступно',
            'direct' => 'відкрити в osu!direct',
            'no_video' => 'без відео',
        ],
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
        'end_session' => 'Завершити сесію ',
        'end_session_confirmation' => 'Сесія на цьому пристрої буде негайно завершена. Ви впевнені?',
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
