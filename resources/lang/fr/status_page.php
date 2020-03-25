<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
