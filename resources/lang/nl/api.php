<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Kan geen leeg bericht verzenden.',
            'limit_exceeded' => 'Je stuurt te snel berichten, wacht even voordat je het weer probeert.',
            'too_long' => 'Het bericht dat u probeert te verzenden, is te lang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Handel als een chatbot.',
        'identify' => 'Identificeer je en lees je openbare profiel.',

        'chat' => [
            'write' => 'Berichten namens jou verzenden.',
        ],

        'forum' => [
            'write' => 'Maak en bewerk forumonderwerpen en berichten namens u.',
        ],

        'friends' => [
            'read' => 'Zie wie u volgt.',
        ],

        'public' => 'Openbare gegevens lezen namens jou.',
    ],
];
