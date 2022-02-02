<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Начать играть',
        'online' => 'из них <strong>:players</strong> онлайн в <strong>:games</strong> матчах',
        'peak' => 'Пик, :count игроков онлайн',
        'players' => 'всего <strong>:count</strong> игроков',
        'title' => 'добро пожаловать',
        'see_more_news' => 'перейти ко всем новостям',

        'slogan' => [
            'main' => 'наилучшая бесплатная ритм-игра',
            'sub' => 'ритм всего лишь в клике от тебя',
        ],
    ],

    'search' => [
        'advanced_link' => 'Расширенный поиск',
        'button' => 'Найти',
        'empty_result' => 'Ничего не найдено!',
        'keyword_required' => 'Требуется ключевое слово для поиска',
        'placeholder' => 'начните печатать',
        'title' => 'Поиск',

        'beatmapset' => [
            'login_required' => 'Войдите в аккаунт для поиска по картам',
            'more' => 'больше :count результатов поиска среди карт',
            'more_simple' => 'Посмотреть другие результаты поиска среди карт',
            'title' => 'Карты',
        ],

        'forum_post' => [
            'all' => 'Все форумы',
            'link' => 'Искать на форуме',
            'login_required' => 'Войдите в аккаунт для поиска по форуму',
            'more_simple' => 'Посмотреть другие результаты поиска на форуме',
            'title' => 'Форумы',

            'label' => [
                'forum' => 'искать на форуме',
                'forum_children' => 'включая подфорумы',
                'topic_id' => 'тема #',
                'username' => 'автор',
            ],
        ],

        'mode' => [
            'all' => 'все',
            'beatmapset' => 'карты',
            'forum_post' => 'форум',
            'user' => 'игроки',
            'wiki_page' => 'вики',
        ],

        'user' => [
            'login_required' => 'Войдите в аккаунт для поиска по пользователям',
            'more' => 'больше :count результатов поиска среди игроков',
            'more_simple' => 'Посмотреть другие результаты поиска среди игроков',
            'more_hidden' => 'Результаты поиска игроков сокращены до :max игроков. Попробуйте уточнить запрос.',
            'title' => 'Игроки',
        ],

        'wiki_page' => [
            'link' => 'Искать в вики',
            'more_simple' => 'Посмотреть другие результаты поиска в вики',
            'title' => 'Вики',
        ],
    ],

    'download' => [
        'tagline' => "давайте<br>начнём!",
        'action' => 'Скачать osu!',

        'help' => [
            '_' => 'если у вас появились проблемы с запуском игры или регистрацией аккаунта, :help_forum_link или :support_button.',
            'help_forum_link' => 'зайдите в раздел помощь на форуме',
            'support_button' => 'свяжитесь с поддержкой',
        ],

        'os' => [
            'windows' => 'для Windows',
            'macos' => 'для macOS',
            'linux' => 'для Linux',
        ],
        'mirror' => 'зеркало',
        'macos-fallback' => 'для macOS',
        'steps' => [
            'register' => [
                'title' => 'создайте аккаунт',
                'description' => 'следуйте подсказкам в самой игре для входа или создания аккаунта',
            ],
            'download' => [
                'title' => 'скачайте игру',
                'description' => 'нажмите на кнопку выше для загрузки установщика игры и запустите его!',
            ],
            'beatmaps' => [
                'title' => 'скачайте карты',
                'description' => [
                    '_' => ':browse библиотеку созданных игроками карт и начните игру!',
                    'browse' => 'откройте',
                ],
            ],
        ],
        'video-guide' => 'видеоинструкция',
    ],

    'user' => [
        'title' => 'главная',
        'news' => [
            'title' => 'Новости',
            'error' => 'Не удалось загрузить последние новости, попробуйте перезагрузить страницу...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Друзей в сети',
                'games' => 'Всего игр',
                'online' => 'Игроков в сети',
            ],
        ],
        'beatmaps' => [
            'new' => 'Новые рейтинговые карты',
            'popular' => 'Популярные карты',
            'by_user' => 'от :user',
        ],
        'buttons' => [
            'download' => 'Скачать osu!',
            'support' => 'Поддержать osu!',
            'store' => 'Магазин osu!store',
        ],
    ],
];
