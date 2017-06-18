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
        'online' => 'из них сейчас <strong>:players</strong> в <strong>:games</strong> играх',
        'peak' => 'Пик :count активных игроков',
        'players' => 'зарегистрировано <strong>:count</strong> игроков',

        'download' => [
            '_' => 'Скачать сейчас',
            'soon' => 'osu! пока доступна только для Windows',
            'for' => 'для :os',
            'other' => 'или для :os1 и :os2',
        ],

        'slogan' => [
            'main' => 'бесплатная ритм-игра',
            'sub' => 'ритм всего лишь в клике от тебя',
        ],
    ],

    'user' => [
        'title' => 'новости',
        'news' => [
            'title' => 'Последние новости',
            'error' => 'Не удалось загрузить последние новости, пробовал обновить страницу?',
        ],
        'header' => [
            'welcome' => 'Привет, <strong>:username</strong>!',
            'messages' => 'У тебя одно новое сообщение|У тебя :count новых сообщений',
            'stats' => [
                'online' => 'Сейчас в игре',
            ],
        ],
        'beatmaps' => [
            'new' => 'Недавно одобренные карты',
            'popular' => 'Популярные карты',
        ],
        'buttons' => [
            'download' => 'Скачать osu!',
            'support' => 'Поддержать osu!',
            'store' => 'osu!store',
        ],
    ],
];
