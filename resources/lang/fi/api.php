<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Ei voida lähettää tyhjää viestiä.',
            'limit_exceeded' => 'Lähetät viestejä liian nopeasti, odota hetki ennen kuin yrität uudelleen.',
            'too_long' => 'Viesti, jota yrität lähettää, on liian pitkä.',
        ],
    ],

    'scopes' => [
        'bot' => 'Toimia viestibottina.',
        'identify' => 'Tunnistaa sinut ja lukea julkista profiiliasi.',

        'chat' => [
            'read' => 'Lukea viestejä sinun nimissäsi.',
            'write' => 'Lähettää viestejä sinun nimissäsi.',
            'write_manage' => 'Liittyä ja lähteä kanavilta sinun nimissäsi.',
        ],

        'forum' => [
            'write' => 'Luoda ja muokata foorumin aiheita ja viestejä sinun nimissäsi.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Nähdä, keitä seuraat.',
        ],

        'multiplayer' => [
            'write_manage' => '',
        ],

        'public' => 'Lukea julkisia tietoja sinun nimissäsi.',
    ],
];
