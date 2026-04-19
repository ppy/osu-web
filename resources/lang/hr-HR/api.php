<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nije moguće poslati praznu poruku.',
            'limit_exceeded' => 'Prebrzo šalješ poruke, molimo te pričekaj trenutak prije nego što pokušaš ponovo.',
            'too_long' => 'Poruka koju pokušavaš poslati je preduga.',
        ],
    ],

    'scopes' => [
        'bot' => 'Se ponašati kao chat bot.',
        'identify' => 'Tebe identificirati i očitati tvoj javni profil.',

        'chat' => [
            'read' => 'Čitati poruke u tvoje ime.',
            'write' => 'Slati poruke u tvoje ime.',
            'write_manage' => 'Spojiti se i napustiti kanale u tvoje ime.',
        ],

        'forum' => [
            'write' => 'Forum teme i objave u tvoje ime kreirati i urediti.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Vidjeti koga pratiš.',
        ],

        'multiplayer' => [
            'write_manage' => '',
        ],

        'public' => 'Čitati javne podatke u tvoje ime.',
    ],
];
