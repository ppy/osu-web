<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'vad händer grabben?',
    ],

    'incidents' => [
        'title' => 'Aktiva incidenter',
        'automated' => 'automatiserad',
    ],

    'online' => [
        'title' => [
            'users' => 'Online-användare under de senaste 24 timmarna',
            'score' => 'Poäng inlämningar under de senaste 24 timmarna',
        ],
        'current' => 'Nuvarande online-användare',
        'score' => 'Poäng inlämningar per sekund',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Senaste incidenter',
            'state' => [
                'resolved' => 'Löst',
                'resolving' => 'Löser',
                'unknown' => 'Okänd',
            ],
        ],

        'uptime' => [
            'title' => 'Drifttid',
            'graphs' => [
                'server' => 'server',
                'web' => 'webb',
            ],
        ],

        'when' => [
            'today' => 'idag',
            'week' => 'vecka',
            'month' => 'månad',
            'all_time' => 'all tid',
            'last_week' => 'förra veckan',
            'weeks_ago' => ':count vecka sedan|:count veckor sedan',
        ],
    ],
];
