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
        'title' => 'status',
        'description' => 'jo man, wat is er allemaal aan de hand?',
    ],

    'incidents' => [
        'title' => 'Actieve Incidenten',
        'automated' => 'geautomatiseerd',
    ],

    'online' => [
        'title' => [
            'users' => 'Online Gebruikers in de afgelopen 24 uur',
            'score' => 'Score Inzendingen in de afgelopen 24 uur',
        ],
        'current' => 'Momenteel Online Gebruikers',
        'score' => 'Score Inzendingen per Seconde',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Recente Incidenten',
            'state' => [
                'resolved' => 'Opgelost',
                'resolving' => 'Aan het oplossen',
                'unknown' => 'Onbekend',
            ],
        ],

        'uptime' => [
            'title' => 'Uptime',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'vandaag',
            'week' => 'week',
            'month' => 'maand',
            'all_time' => 'altijd',
            'last_week' => 'afgelopen week',
            'weeks_ago' => ':count week geleden|:count weken geleden',
        ],
    ],
];
