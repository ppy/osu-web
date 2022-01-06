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
            'sub' => 'ритм усього лиш за клік від вас',
        ],
    ],

    'search' => [
        'advanced_link' => 'Розширений пошук',
        'button' => 'Шукати',
        'empty_result' => 'Нічого не знайдено!',
        'keyword_required' => 'Потрібно ключове слово для пошуку',
        'placeholder' => 'введіть текст для пошуку',
        'title' => 'Пошук',

        'beatmapset' => [
            'login_required' => 'Увійдіть для пошуку карт',
            'more' => 'більше :count результатів пошуку серед карт',
            'more_simple' => 'Подивитися інші результати пошуку в картах',
            'title' => 'Карти',
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
                'topic_id' => 'тема #',
                'username' => 'автор',
            ],
        ],

        'mode' => [
            'all' => 'всі',
            'beatmapset' => 'карти',
            'forum_post' => 'форум',
            'user' => 'гравці',
            'wiki_page' => 'вікі',
        ],

        'user' => [
            'login_required' => 'Увійдіть для пошуку користувачів',
            'more' => 'більше :count результатів пошуку серед гравців',
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
        'tagline' => "давайте<br>розпочнемо!",
        'action' => 'Завантажити osu!',

        'help' => [
            '_' => 'якщо у вас виникла проблема з запуском гри чи реєстрацією облікового запису, :help_forum_link або :support_button.',
            'help_forum_link' => 'перевірте довідковий форум',
            'support_button' => 'зверніться до служби підтримки',
        ],

        'os' => [
            'windows' => 'для Windows',
            'macos' => 'для macOS',
            'linux' => 'для Linux',
        ],
        'mirror' => 'дзеркало',
        'macos-fallback' => 'для macOS',
        'steps' => [
            'register' => [
                'title' => 'створіть акаунт',
                'description' => 'слідуйте підказкам в самій грі для входу або створення облікового запису',
            ],
            'download' => [
                'title' => 'завантажте гру',
                'description' => 'натисніть на кнопку вище для завантаження інсталятора гри і запустіть його!',
            ],
            'beatmaps' => [
                'title' => 'скачайте карти',
                'description' => [
                    '_' => ':browse бібліотеку створених гравцями карт і почніть гру!',
                    'browse' => 'відкрийте',
                ],
            ],
        ],
        'video-guide' => 'відео інструкція',
    ],

    'user' => [
        'title' => 'головна',
        'news' => [
            'title' => 'Новини',
            'error' => 'Не вдалося завантажити останні новини. Ви можете спробуйте перезавантажити сторінку?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Друзів онлайн',
                'games' => 'Ігор зіграно',
                'online' => 'Користувачі онлайн',
            ],
        ],
        'beatmaps' => [
            'new' => 'Останні рангові карти',
            'popular' => 'Популярні карти',
            'by_user' => 'від :user',
        ],
        'buttons' => [
            'download' => 'Завантажити osu!',
            'support' => 'Підтримати osu!',
            'store' => 'Магазин osu!',
        ],
    ],
];
