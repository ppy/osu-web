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
    'header' => [
        'title' => 'állapot',
        'description' => 'mi a helyzet, haver?',
    ],

    'incidents' => [
        'title' => 'Aktív Incidensek',
        'automated' => 'automatizált',
    ],

    'online' => [
        'title' => [
            'users' => 'Elérhető Felhasználók az elmúlt 24 órában',
            'score' => 'Pontszám beküldések az elmúlt 24 órában',
        ],
        'current' => 'Jelenleg Elérhető Felhasználók',
        'score' => 'Pontszám beküldések másodpercenként',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Legutóbbi Incidensek',
            'state' => [
                'resolved' => 'Megoldott',
                'resolving' => 'Megoldás alatt',
                'unknown' => 'Ismeretlen',
            ],
        ],

        'uptime' => [
            'title' => 'Üzemidő',
            'graphs' => [
                'server' => 'szerver',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'ma',
            'week' => 'hét',
            'month' => 'hónap',
            'all_time' => 'összes',
            'last_week' => 'múlt hét',
            'weeks_ago' => ':count héttel ez előtt |:count héttel ez előtt',
        ],
    ],
];
