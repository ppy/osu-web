<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'feed_title' => 'лента',
    'generic' => 'Исправления ошибок и мелкие улучшения.',

    'build' => [
        'title' => 'изменения в :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited игрок в сети|:count_delimited игрока в сети|:count_delimited игроков в сети',
    ],

    'entry' => [
        'by' => 'от :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'список изменений',
            '_from' => 'изменения после :from',
            '_from_to' => 'изменения между :from и :to',
            '_stream' => 'изменения в :stream',
            '_stream_from' => 'изменения в :stream после :from',
            '_stream_from_to' => 'изменения в :stream между :from и :to',
            '_stream_to' => 'изменения в :stream до :to',
            '_to' => 'изменения до :to',
        ],

        'title' => [
            '_' => 'История изменений :info',
            'info' => 'Список',
        ],
    ],

    'support' => [
        'heading' => 'Понравилось обновление?',
        'text_1' => 'Поддержите будущее разработки osu! и :link сегодня!',
        'text_1_link' => 'купите osu!supporter',
        'text_2' => 'Вы не только ускорите разработку, но и получите дополнительные возможности!',
    ],
];
