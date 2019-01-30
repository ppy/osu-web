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
        'title' => 'statut',
        'description' => 'qu\'est ce qui se passe mec ?',
    ],

    'incidents' => [
        'title' => 'Incidents actifs',
        'automated' => 'automatique',
    ],

    'online' => [
        'title' => [
            'users' => 'Utilisateurs en ligne dans les dernières 24h',
            'score' => 'Envois de score dans les dernières 24h',
        ],
        'current' => 'Utilisateurs en ligne',
        'score' => 'Envoi de score par secondes',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidents récents',
            'state' => [
                'resolved' => 'Résolu',
                'resolving' => 'Résolution',
                'unknown' => 'Inconnu',
            ],
        ],

        'uptime' => [
            'title' => 'Temps de fonctionnement',
            'graphs' => [
                'server' => 'serveur',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'aujourd\'hui',
            'week' => 'semaine',
            'month' => 'mois',
            'all_time' => 'tout le temps',
            'last_week' => 'dernière semaine',
            'weeks_ago' => 'il y a :count semaine|il y a :count semaines',
        ],
    ],
];
