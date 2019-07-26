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
    'header' => [
        'title' => 'tila',
        'description' => 'kuis hurisee?',
    ],

    'incidents' => [
        'title' => 'Aktiiviset tapahtumat',
        'automated' => 'automatisoitu',
    ],

    'online' => [
        'title' => [
            'users' => 'Paikalla olevia käyttäjiä viimeisen 24 tunnin aikana',
            'score' => 'Pelikerrat viimeisen 24 tunnin aikana',
        ],
        'current' => 'Tällä hetkellä paikalla olevat käyttäjät',
        'score' => 'Peliä sekunnissa',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Viimeisimmät Tapahtumat',
            'state' => [
                'resolved' => 'Ratkaistu',
                'resolving' => 'Ratkaistaan',
                'unknown' => 'Tuntematon',
            ],
        ],

        'uptime' => [
            'title' => 'Käynnissäoloaika',
            'graphs' => [
                'server' => 'palvelin',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'tänään',
            'week' => 'viikko',
            'month' => 'kuukausi',
            'all_time' => 'koko aika',
            'last_week' => 'viime viikko',
            'weeks_ago' => ':count viikko sitten|:count viikkoa sitten',
        ],
    ],
];
