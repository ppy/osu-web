<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Не можете да изпращате празни съобщения.',
            'limit_exceeded' => 'Вие изпращате съобщения прекалено бързо, моля изчакайте малко преди да опитате отново.',
            'too_long' => 'Съобщението, което се опитвате да изпратите, е твърде дълго.',
        ],
    ],

    'scopes' => [
        'bot' => '',
        'identify' => 'Идентифицира те и ти прочита публичния профил.',

        'chat' => [
            'write' => '',
        ],

        'forum' => [
            'write' => '',
        ],

        'friends' => [
            'read' => 'Вижте кого следвате.',
        ],

        'public' => 'Четене на публични данни от ваше име.',
    ],
];
