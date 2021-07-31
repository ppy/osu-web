<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Kan ikke sende tom melding.',
            'limit_exceeded' => 'Du sender meldinger for fort, vennligst vent litt før du prøver igjen.',
            'too_long' => 'Meldingen du prøver å sende er for lang.',
        ],
    ],

    'scopes' => [
        'bot' => '',
        'identify' => 'Identifiser deg selv og les din offentlige profil.',

        'chat' => [
            'write' => 'Send meldinger på dine vegne.',
        ],

        'forum' => [
            'write' => '',
        ],

        'friends' => [
            'read' => 'Se hvem du følger.',
        ],

        'public' => 'Les offentlige data på dine vegne.',
    ],
];
