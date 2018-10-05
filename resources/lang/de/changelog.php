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
    'feed_title' => 'feed',
    'generic' => 'Bugfixes und kleine Verbesserungen.',

    'build' => [
        'title' => 'Änderungen in :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited user online |:count_delimited user online',
    ],

    'entry' => [
        'by' => 'von :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'Changelog Eintrag',
            '_from' => 'Änderungen seit :from',
            '_from_to' => 'Änderungen zwischen :from und :to',
            '_stream' => 'Änderungen in :stream',
            '_stream_from' => 'Änderungen in :stream seit :from',
            '_stream_from_to' => 'Änderungen in Stream zwischen :from und :to',
            '_stream_to' => 'Änderungen in :stream bis zum :to',
            '_to' => 'Änderungen bis zum :to',
        ],

        'title' => [
            '_' => 'Changelog :info',
            'info' => 'Auflistung',
        ],
    ],

    'support' => [
        'heading' => 'Dir gefällt, was du siehst?',
        'text_1' => 'Unterstütze die weitere Entwicklung von osu! und :link!',
        'text_1_link' => 'werde noch heute Supporter!',
        'text_2' => 'Damit treibst du nicht nur die Entwicklung schneller voran, sondern erhältst auch einige coole Features und besondere Anpassungsmöglichkeiten!',
    ],
];
