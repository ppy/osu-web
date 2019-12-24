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
    'generic' => 'Feilrettinger og mindre forbedringer',

    'build' => [
        'title' => 'endringer i :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited brukere pålogget|:count_delimited brukere pålogget',
    ],

    'entry' => [
        'by' => 'av :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'endringslogg liste',
            '_from' => 'endringer siden :from',
            '_from_to' => 'endringer mellom :from og :to',
            '_stream' => 'endringer i :stream',
            '_stream_from' => 'endringer i :stream siden :from',
            '_stream_from_to' => 'endringer i :stream mellom :from og :to',
            '_stream_to' => 'endringer i :stream opp til :to',
            '_to' => 'endringer opp til :to',
        ],
    ],

    'support' => [
        'heading' => 'Liker du denne oppdateringen?',
        'text_1' => 'Støtt videreutviklingen av osu! og :link i dag!',
        'text_1_link' => 'bli en osu!supporter',
        'text_2' => 'Du vil ikke bare hjelpe til med å framskynde utviklingen, men du vil også da tilgang til ekstra funksjoner og tilpasninger!',
    ],
];
