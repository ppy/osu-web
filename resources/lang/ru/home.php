<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'download' => 'Скачать сейчас',
        'online' => 'из них <strong>:players</strong> сейчас в <strong>:games</strong> играх',
        'peak' => 'Пик, :count активных игроков',
        'players' => 'зарегистрировано <strong>:count</strong> игроков',

        'slogan' => [
            'main' => 'лучшая бесплатная ритм-игра',
            'sub' => 'ритм всего лишь в клике от Вас',
        ],
    ],

    'search' => [
        'advanced_link' => 'Расширенный поиск',
        'button' => 'Найти',
        'empty_result' => 'Ничего не найдено!',
        'missing_query' => 'Для поиска необходимо как минимум :n символов',
        'title' => 'Результаты поиска',

        'beatmapset' => [
            'more' => 'больше :count результатов поиска среди карт',
            'more_simple' => 'Посмотреть другие результаты поиска в картах',
            'title' => 'Карты',
        ],

        'forum_post' => [
            'all' => 'Все форумы',
            'link' => 'Искать на форуме',
            'more_simple' => 'Посмотреть другие результаты поиска на форуме',
            'title' => 'Форумы',

            'label' => [
                'forum' => 'искать на форуме',
                'forum_children' => 'включая подфорумы',
                'username' => 'автор',
            ],
        ],

        'mode' => [
            'all' => 'все',
            'beatmapset' => 'карты',
            'forum_post' => 'форумы',
            'user' => 'игроки',
            'wiki_page' => 'вики',
        ],

        'user' => [
            'more' => 'больше :count результатов поиска среди игроков',
            'more_simple' => 'Посмотреть другие результаты поиска среди игроков',
            'title' => 'Игроки',
        ],

        'wiki_page' => [
            'link' => 'Искать в вики',
            'more_simple' => 'Посмотреть другие результаты поиска в вики',
            'title' => 'Вики',
        ],
    ],

    'download' => [
        'tagline' => 'давайте<br>начнём!',
        'action' => 'Скачать osu!',
        'os' => [
            'windows' => 'для Windows',
            'macos' => 'для macOS',
            'linux' => 'для Linux',
        ],
        'mirror' => 'зеркало',
        'macos-fallback' => 'для macOS',
        'steps' => [
            'download' => [
                'title' => 'скачайте игру',
                'description' => 'нажмите на кнопку выше для загрузки игры, и запустите его!',
            ],
            'register' => [
                'title' => 'создайте аккаунт',
                'description' => 'следуйте подсказкам в самой игре для входа или создания аккаунта',
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
            'welcome' => 'Привет, <strong>:username</strong>!',
            'messages' => '{0} У Вас нет новых сообщений|{1} У Вас одно новое сообщение|{2} У Вас 2 новых сообщения|[3,*] У Вас :count новых сообщений',
            'stats' => [
                'friends' => 'Друзей в сети',
                'games' => 'Всего игр',
                'online' => 'Игроков в сети',
            ],
        ],
        'beatmaps' => [
            'new' => 'Последние одобренные карты',
            'popular' => 'Популярные карты',
            'by' => 'от',
            'plays' => 'сыграно :count раз',
        ],
        'buttons' => [
            'download' => 'Скачать osu!',
            'support' => 'Поддержать osu!',
            'store' => 'Магазин osu!store',
        ],
    ],
];
