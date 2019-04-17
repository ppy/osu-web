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
    'feed_title' => 'feed',
    'generic' => 'Fejlrettelser og små forbedringer.',

    'build' => [
        'title' => 'ændringer i :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited bruger online|:count_delimited brugere online',
    ],

    'entry' => [
        'by' => 'af :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'udgivelses noter',
            '_from' => 'ændringer siden :from',
            '_from_to' => 'ændringer mellem :from og :to',
            '_stream' => 'ændringer i :stream',
            '_stream_from' => 'ændringer i :stream siden :from',
            '_stream_from_to' => 'ændringer i :stream mellem :from og :to',
            '_stream_to' => 'ændringer i :stream op til :to',
            '_to' => 'ændringer op til :to',
        ],

        'title' => [
            '_' => 'Ændringsoversigt :info',
            'info' => 'Listning',
        ],
    ],

    'support' => [
        'heading' => 'Elsker du denne opdatering?',
        'text_1' => 'Støt yderligere udvikling af osu! og bliv en :link i dag!',
        'text_1_link' => 'osu! supporter',
        'text_2' => 'Ikke blot vil du hjælpe hastighed udvikling, men du vil også få nogle ekstra funktioner og tilpasninger!',
    ],
];
