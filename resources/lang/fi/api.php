<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Ei voida lähettää tyhjää viestiä.',
            'limit_exceeded' => 'Lähetät viestejä liian nopeasti, odota hetki ennen kuin yrität uudelleen.',
            'too_long' => 'Viesti jota yrität lähettää on liian pitkä.',
        ],
    ],

    'scopes' => [
        'bot' => 'Toimi chat-bottina.',
        'identify' => 'Tunnista itsesi ja lue julkista profiiliasi.',

        'chat' => [
            'write' => 'Lähetä viestejä puolestasi.',
        ],

        'forum' => [
            'write' => '',
        ],

        'friends' => [
            'read' => 'Näe ketä seuraat.',
        ],

        'public' => 'Lue julkisia tietoja puolestasi.',
    ],
];
