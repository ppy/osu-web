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
    'feed_title' => 'hírfolyam',
    'generic' => 'Hibajavítások és kisebb fejlesztések.',

    'build' => [
        'title' => 'változtatások a :version -ben',
    ],

    'builds' => [
        'users_online' => ':count_delimited felhasználó online|:count_delimited felhasználók online',
    ],

    'entry' => [
        'by' => ':user által',
    ],

    'index' => [
        'page_title' => [
            '_' => 'változtatások listája',
            '_from' => 'változtatások :from óta',
            '_from_to' => ':from és :to közötti változtatások',
            '_stream' => ':stream változtatások',
            '_stream_from' => ':stream változtatások :from óta',
            '_stream_from_to' => ':stream változtatások :from és :to között',
            '_stream_to' => ':stream változtatások :to -ig',
            '_to' => 'változtatások :to -ig',
        ],

        'title' => [
            '_' => 'Változtatások :info',
            'info' => 'Listázás',
        ],
    ],

    'support' => [
        'heading' => 'Tetszik ez a frissítés?',
        'text_1' => 'Támogasd az osu! további fejlesztését és :link még ma!',
        'text_1_link' => 'legyél támogató',
        'text_2' => 'Nem csak a gyors fejlesztést segíted, de még sok extra funkciót és egyediségi lehetőséget kapsz!',
    ],
];
