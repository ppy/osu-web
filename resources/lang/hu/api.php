<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nem küldhetsz üres üzenetet.',
            'limit_exceeded' => 'Túl gyorsan küldöd az üzeneteket, kérlek várj egy keveset, mielőtt újrapróbálnád.',
            'too_long' => 'Túl hosszú üzenetet próbálsz küldeni.',
        ],
    ],

    'scopes' => [
        'bot' => 'Csevegőrobotként működjön.',
        'identify' => 'Azonosíthat téged és olvashat a nyilvános profilodból.',

        'chat' => [
            'write' => 'Küldjön üzeneteket az Ön nevében.',
        ],

        'forum' => [
            'write' => 'Csak a saját nevedben hozz létre és szerkessz fórum posztokat.',
        ],

        'friends' => [
            'read' => 'Lásd, hogy kit követsz.',
        ],

        'public' => 'Nyilvános adatok olvasása az ön nevében',
    ],
];
