<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nije moguće poslati praznu poruku.',
            'limit_exceeded' => 'Prebrzo šaljete poruke, molim vas sačekajte trenutak prije nego što pokušate ponovo.',
            'too_long' => 'Poruka koju pokušavaš poslati je preduga.',
        ],
    ],

    'scopes' => [
        'bot' => 'Se ponašati kao chat bot.',
        'identify' => 'Tebe identificirati i očitati tvoj javni profil.',

        'chat' => [
            'write' => 'Slati poruke u tvoje ime.',
        ],

        'forum' => [
            'write' => 'Forum teme i objave u tvoje ime kreirati i urediti.',
        ],

        'friends' => [
            'read' => 'Vidjeti koga pratiš.',
        ],

        'public' => 'Čitati javne podatke u tvoje ime.',
    ],
];
