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
    'feed_title' => 'syöte',
    'generic' => 'Vikojen korjauksia ja pieniä parannuksia.',

    'build' => [
        'title' => 'muutokset versiossa :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited käyttäjä paikalla|:count_delimited käyttäjää paikalla',
    ],

    'entry' => [
        'by' => 'käyttäjältä :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'muutosloki listaus',
            '_from' => '',
            '_from_to' => '',
            '_stream' => '',
            '_stream_from' => '',
            '_stream_from_to' => '',
            '_stream_to' => '',
            '_to' => '',
        ],

        'title' => [
            '_' => 'Muutosloki :info',
            'info' => 'Listaus',
        ],
    ],

    'support' => [
        'heading' => 'Onko tämä päivitys mieleesi?',
        'text_1' => 'Tue osu!:n kehittämistä ja :link tänään!',
        'text_1_link' => 'ryhdy tukijaksi',
        'text_2' => 'Tukesi ei ainoastaan nopeuta pelin kehittämistä, vaan saat myös lisätoimintoja sekä enemmän muokkausvapautta!',
    ],
];
