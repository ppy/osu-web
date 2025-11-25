<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Завантажити зараз',
        'online' => 'з них <strong>:players</strong> зараз в <strong>:games</strong> іграх',
        'peak' => 'Пік, :count користувачів онлайн',
        'players' => 'зареєстровано <strong>:count</strong> гравців',
        'title' => 'ласкаво просимо',
        'see_more_news' => 'побачити більше новин',

        'slogan' => [
            'main' => 'найкраща безкоштовна ритм-гра',
            'sub' => 'ритм усього лиш в кліці від вас',
        ],
    ],

    'search' => [
        'advanced_link' => 'Розширений пошук',
        'button' => 'Шукати',
        'empty_result' => 'Нічого не знайдено!',
        'keyword_required' => 'Потрібно ключове слово для пошуку',
        'placeholder' => 'введіть текст для пошуку',
        'title' => 'Пошук',

        'artist_track' => [
            'more_simple' => 'Переглянути додаткові результати пошуку пісень обраних виконавців',
        ],
        'beatmapset' => [
            'login_required' => 'Увійдіть для пошуку карт',
            'more' => 'більше :count результатів пошуку серед карт',
            'more_simple' => 'Подивитися інші результати пошуку в мапах',
            'title' => 'Бітмапи',
        ],

        'forum_post' => [
            'all' => 'Всі форуми',
            'link' => 'Пошук на форумі',
            'login_required' => 'Увійдіть для пошуку по форуму',
            'more_simple' => 'Подивитися інші результати пошуку на форумі',
            'title' => 'Форум',

            'label' => [
                'forum' => 'пошук на форумі',
                'forum_children' => 'включаючи підфоруми',
                'include_deleted' => 'включаючи видалені публікації',
                'topic_id' => 'тема #',
                'username' => 'автор',
            ],
        ],

        'mode' => [
            'all' => 'всі',
            'artist_track' => 'пісні обраних виконавців',
            'beatmapset' => 'бітмапи',
            'forum_post' => 'форум',
            'team' => 'команди',
            'user' => 'гравці',
            'wiki_page' => 'вікі',
        ],

        'team' => [
            'more_simple' => 'Переглянути інші результати пошуку команд',
        ],

        'user' => [
            'login_required' => 'Увійдіть для пошуку користувачів',
            'more' => ':count більше результатів пошуку серед гравців',
            'more_simple' => 'Подивитися інші результати пошуку серед гравців',
            'more_hidden' => 'Результати пошуку гравців скорочені до :max гравців. Спробуйте уточнити запит.',
            'title' => 'Гравці',
        ],

        'wiki_page' => [
            'link' => 'Пошук на вікі',
            'more_simple' => 'Подивитися інші результати пошуку на вікі',
            'title' => 'Вікі',
        ],
    ],

    'download' => [
        'action_lazer_info' => 'перейдіть на цю сторінку для того що дізнатись більше інформації',
        'download' => '',
        'for_os' => 'для :os',
        'macos-fallback' => 'для macOS',
        'mirror' => 'дзеркало',
        'or' => 'або',
        'os_version_or_later' => ':os_version або новіше',
        'other_os' => 'інші платформи',
        'quick_start_guide' => 'короткий посібник',
        'stable_text' => '',
        'tagline_1' => '',
        'tagline_2' => '',
        'video-guide' => 'відео інструкція',

        'help' => [
            '_' => 'якщо у вас є проблеми з запуском гри або реєстрацією облікового запису, :help_forum_link або :support_button.',
            'help_forum_link' => 'перевірте довідковий форум',
            'support_button' => 'зверніться до служби підтримки',
        ],

        'os' => [
            'windows' => 'для Windows',
            'macos' => 'для macOS',
            'linux' => 'для Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'створіть обліковий запис',
                'description' => 'слідуйте підказкам в самій грі для входу або створення облікового запису',
            ],
            'download' => [
                'title' => 'завантажте гру',
                'description' => 'натисніть на кнопку вище для завантаження інсталятора гри і запустіть його!',
            ],
            'beatmaps' => [
                'title' => 'завантажте мапи',
                'description' => [
                    '_' => ':browse простору бібліотеку мап створених гравцями й почніть гру!',
                    'browse' => 'відкрийте',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'головна',
        'news' => [
            'title' => 'Новини',
            'error' => 'Не вдалося завантажити останні новини. Може спробуєте перезавантажити сторінку?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Друзів онлайн',
                'games' => 'Ігор',
                'online' => 'Користувачів онлайн',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => 'Бітмапа дня',
            'new' => 'Нові рейтингові мапи',
            'popular' => 'Популярні мапи',
            'by_user' => 'від :user',
            'resets' => 'скидується :ends',
        ],
        'buttons' => [
            'download' => 'Завантажити osu!',
            'support' => 'Підтримати osu!',
            'store' => 'Магазин osu!',
        ],
        'show' => [
            'admin' => [
                'page' => 'Відкрити консоль адміністратора',
            ],
        ],
    ],
];
