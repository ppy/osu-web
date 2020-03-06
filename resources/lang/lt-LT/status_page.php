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
        'title' => 'būsena',
        'description' => 'kaip einas?',
    ],

    'incidents' => [
        'title' => 'Neišspręstos problemos',
        'automated' => 'automatiniai',
    ],

    'online' => [
        'title' => [
            'users' => 'Prisijungimų kiekis per paskutines 24 valandas',
            'score' => 'Pateikta Taškų per paskutine 24 Valandas',
        ],
        'current' => 'Šiuo Metu Prisijungę Vartotojai',
        'score' => 'Pateikta Taškų per Sekundę',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Paskutiniai pažeidimai',
            'state' => [
                'resolved' => 'Išspręsta',
                'resolving' => 'Sprendžiama',
                'unknown' => 'Nežinoma',
            ],
        ],

        'uptime' => [
            'title' => 'Veikimo laikas',
            'graphs' => [
                'server' => 'serveris',
                'web' => 'internetas',
            ],
        ],

        'when' => [
            'today' => 'šiandien',
            'week' => 'savaitė',
            'month' => 'mėnesis',
            'all_time' => 'visą laiką',
            'last_week' => 'praeita savaitę',
            'weeks_ago' => ':count prieš savaitę|:count prieš savaites',
        ],
    ],
];
