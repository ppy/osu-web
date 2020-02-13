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
        'download' => 'Скачать сейчас',
        'online' => 'из них <strong>:players</strong> сейчас в <strong>:games</strong> играх',
        'peak' => 'Пик, :count активных игроков',
        'players' => 'зарегистрировано <strong>:count</strong> игроков',
        'title' => 'добро пожаловать',
        'see_more_news' => 'посмотреть больше новостей',

        'slogan' => [
            'main' => 'наилучшайшая бесплатная ритм-игра',
            'sub' => 'ритм всего лишь в клике от вас',
        ],
    ],

    'search' => [
        'advanced_link' => 'Расширенный поиск',
        'button' => 'Найти',
        'empty_result' => 'Ничего не найдено!',
        'keyword_required' => 'Требуется ключевое слово для поиска',
        'placeholder' => 'введите текст для поиска',
        'title' => 'Поиск',

        'beatmapset' => [
            'more' => 'больше :count результатов поиска среди карт',
            'more_simple' => 'Посмотреть другие результаты поиска среди карт',
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
        'title' => 'инфопанель',
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
            'by_user' => 'от:user',
        ],
        'buttons' => [
            'download' => 'Скачать osu!',
            'support' => 'Поддержать osu!',
            'store' => 'Магазин osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Вау!',
        'subtitle' => 'Кажется, вы хорошо проводите своё время! :D',
        'body' => [
            'part-1' => 'Знаете ли вы, что в osu! нет рекламы, и что она полагается на игроков для поддержки своей разработки и оплату финансовых расходов?',
            'part-2' => 'Знали ли вы что поддерживая osu! вы получаете большое количество приятных плюшек, к примеру <strong>внутриигровую загрузку карт</strong>, которая срабатывает автоматически при наблюдении или в мультиплеере.',
        ],
        'find-out-more' => 'Нажмите сюда для подробностей!',
        'download-starting' => "Ах да, не беспокойтесь - загрузка карты уже началась ;)",
    ],
];
