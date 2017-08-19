<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'title' => 'status',
        'description' => 'co się dzieje, ziomek?',
    ],

    'incidents' => [
        'title' => 'Obecne problemy',
        'automated' => 'zautomatyzowane',
    ],

    'online' => [
        'title' => [
            'users' => 'Ilość użytkoników online w ciągu ostatnich 24 godzin',
            'score' => 'Ilość ustanowionych wyników w ciągu ostatnich 24 godzin',
        ],
        'current' => 'Obecnie online',
        'score' => 'Ilość ustanawianych wyników na sekundę',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Niedawne problemy',
            'state' => [
                'resolved' => 'Rozwiązane',
                'resolving' => 'W trakcie rozwiązywania',
                'unknown' => 'Nieznane',
            ],
        ],

        'uptime' => [
            'title' => 'Czas pracy',
            'graphs' => [
                'server' => 'serwer',
                'web' => 'strona',
            ],
        ],

        'when' => [
            'today' => 'dzisiaj',
            'week' => 'tydzień',
            'month' => 'miesiąc',
            'all_time' => 'od zawsze',
            'last_week' => 'ostatni tydzień',
            'weeks_ago' => '{1} tydzień temu|[2,4] :count tygodnie temu|{5,*} :count tygodni temu',
        ],
    ],
];
