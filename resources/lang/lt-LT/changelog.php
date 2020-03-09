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
    'generic' => 'Pataisytos klaidos ir smulkūs patobulinimai',

    'build' => [
        'title' => ':version pakeitimai',
    ],

    'builds' => [
        'users_online' => ':count_delimited prisijungęs vartotojas|:count_delimited prisijungę vartotojai',
    ],

    'entry' => [
        'by' => 'dėka :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'pakeitimų sąrašas',
            '_from' => 'pakeitimai prieš :from',
            '_from_to' => 'pakeitimai tarp :from ir :to',
            '_stream' => ':stream pakeitimai',
            '_stream_from' => ':stream pakeitimai nuo :from',
            '_stream_from_to' => ':stream pakeitimai nuo :from iki :to',
            '_stream_to' => ':stream pakeitimai iki :to',
            '_to' => 'pakeitimai iki :to',
        ],
    ],

    'support' => [
        'heading' => 'Patinka šie pakeitimai?',
        'text_1' => 'Paremk osu! kūrimą ateityje ir :link dabar!',
        'text_1_link' => 'tapk osu! rėmėju',
        'text_2' => 'Tai ne tik padės pagreitinti osu! kūrimą, bet ir suteiks tau šiek tiek papildomų funkcijų bei nustatymų!',
    ],
];
