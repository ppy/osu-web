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
        'bot' => 'Fungere som en chattbot.',
        'identify' => 'Identifiser deg selv og les din offentlige profil.',

        'chat' => [
            'read' => 'Les meldinger på dine vegne.',
            'write' => 'Send meldinger på dine vegne.',
            'write_manage' => 'Bli med og forlat kanaler på dine vegne.',
        ],

        'forum' => [
            'write' => 'Opprett og rediger forumemner og innlegg på dine vegne.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Se hvem du følger.',
        ],

        'public' => 'Les offentlige data på dine vegne.',
    ],
];
