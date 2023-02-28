<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Kan ikke sende en tom besked.',
            'limit_exceeded' => 'Du sender beskeder for hurtigt, vent venligst lidt før du prøver igen.',
            'too_long' => 'Beskeden du prøver at sende er for lang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Handl som en chat bot.',
        'identify' => 'Identificere dig og læse din offentlige profil.',

        'chat' => [
            'write' => 'Send beskeder på dine vegne.',
        ],

        'forum' => [
            'write' => 'Opret og rediger forumemner og indlæg på dine vegne.',
        ],

        'friends' => [
            'read' => 'Se hvem du følger.',
        ],

        'public' => 'Læs offentlige data på dine vegne.',
    ],
];
