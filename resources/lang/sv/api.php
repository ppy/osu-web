<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Kan ej skicka tomma meddelanden.',
            'limit_exceeded' => 'Du skickar meddelanden för snabbt, vänligen vänta lite innan du försöker igen.',
            'too_long' => 'Meddelandet du försöker skicka är för långt.',
        ],
    ],

    'scopes' => [
        'bot' => 'Agera som en chattbot.',
        'identify' => 'Identifiera dig och läs din offentliga profil.',

        'chat' => [
            'write' => 'Skicka meddelanden åt dig.',
        ],

        'forum' => [
            'write' => 'Skapa och redigera forumämnen och inlägg åt dig.',
        ],

        'friends' => [
            'read' => 'Se vem du följer.',
        ],

        'public' => 'Läs offentlig data för dina vägnar',
    ],
];
