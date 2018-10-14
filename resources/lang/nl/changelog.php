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
    'generic' => 'Bugfixes en kleine verbeteringen.',

    'build' => [
        'title' => 'veranderingen in :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited gebruiker online|:count_delimited gebruikers online',
    ],

    'entry' => [
        'by' => 'door :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'changelog index',
            '_from' => 'veranderingen sinds :from',
            '_from_to' => 'veranderingen tussen :from en :to',
            '_stream' => 'veranderingen in :stream',
            '_stream_from' => 'veranderingen in :stream sinds :from',
            '_stream_from_to' => 'veranderingen in :stream tussen :from en :to',
            '_stream_to' => 'veranderingen in :stream tot :to',
            '_to' => 'veranderingen tot :to',
        ],

        'title' => [
            '_' => 'Changelog :info',
            'info' => 'Index',
        ],
    ],

    'support' => [
        'heading' => 'Hou je van deze update?',
        'text_1' => 'Ondersteun de verdere ontwikkeling van osu! en :link vandaag!',
        'text_1_link' => 'word een supporter',
        'text_2' => 'Zo help je niet alleen development te versnellen, maar krijg je ook extra features en costumizations!',
    ],
];
