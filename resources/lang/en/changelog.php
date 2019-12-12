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
    'generic' => 'Bug fixes and minor improvements',

    'build' => [
        'title' => 'changes in :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited user online|:count_delimited users online',
    ],

    'entry' => [
        'by' => 'by :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'changelog listing',
            '_from' => 'changes since :from',
            '_from_to' => 'changes between :from and :to',
            '_stream' => 'changes in :stream',
            '_stream_from' => 'changes in :stream since :from',
            '_stream_from_to' => 'changes in :stream between :from and :to',
            '_stream_to' => 'changes in :stream up to :to',
            '_to' => 'changes up to :to',
        ],
    ],

    'support' => [
        'heading' => 'Love this update?',
        'text_1' => 'Support further development of osu! and :link today!',
        'text_1_link' => 'become an osu!supporter',
        'text_2' => 'Not only will you help speed development, but you will also get some extra features and customisations!',
    ],
];
