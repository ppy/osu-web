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
    'landing' => [
        'download' => 'Завантажити зараз',
        'online' => 'з них <strong>:players</strong> зараз в <strong>:games</strong> іграх',
        'peak' => 'Пік, :count користувачів онлайн',
        'players' => 'зареєстровано <strong>:count</strong> гравців',
        'title' => 'ласкаво просимо',
        'see_more_news' => 'побачити більше новин',

        'slogan' => [
            'main' => 'найкраща безкоштовна ритм-гра',
            'sub' => 'ритм всього лиш в кліку від вас',
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
            'more' => 'більше :count результатів пошуку серед карт',
            'more_simple' => 'Подивитися інші результати пошуку в картах',
            'title' => 'Карти',
        ],

        'forum_post' => [
            'all' => 'Всі форуми',
            'link' => 'Пошук на форумі',
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

    'support-osu' => [
        'title' => 'Вау!',
        'subtitle' => 'Здається, ви добре проводите свій час! :D',
        'body' => [
            'part-1' => 'Чи знали ви що в osu!, немає реклами, і вона покладається на гравців, для підтримки своєї розробки і оплати фінансових витрат?',
            'part-2' => 'Чи знали ви що підтримуючи osu! ви одержуєте цілу купу приємних функцій, наприклад <strong> внутрішньоігрове завантаження карт </strong>, під час спостереження або в багатокористувальницьких іграх?',
        ],
        'find-out-more' => 'Натисніть сюди щоб дізнатись більше!',
        'download-starting' => "Ох, не турбуйтеся - завантаження карти вже почалося;)",
    ],
];
