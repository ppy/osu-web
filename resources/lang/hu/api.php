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
        'bot' => 'Csevegőrobotként működni.',
        'identify' => 'Azonosíthat téged és olvashat a nyilvános profilodból.',

        'chat' => [
            'read' => 'Olvasni üzeneteket a nevedben.',
            'write' => 'Üzeneteket küldeni a nevedben.',
            'write_manage' => 'Csatornákhoz csatlakozni, vagy azokat elhagyni a nevedben.',
        ],

        'forum' => [
            'write' => 'Létrehozni és szerkeszteni fórum posztokat a nevedben.',
            'write_manage' => 'A fórum témáit és hozzászólásait kezelni a nevedben.',
        ],

        'friends' => [
            'read' => 'Lásd, hogy kit követsz.',
        ],

        'multiplayer' => [
            'write_manage' => 'Többjátékos szobákat létrehozni és kezelni a nevedben.',
        ],

        'public' => 'Nyilvános adatokat olvasni a nevedben.',
    ],
];
