<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Не може да изпращате празни съобщения.',
            'limit_exceeded' => 'Вие изпращате съобщения прекалено бързо, моля изчакайте малко преди да опитате отново.',
            'too_long' => 'Съобщението, което опитвате да изпратите, е твърде дълго.',
        ],
    ],

    'scopes' => [
        'bot' => 'Действа като чат бот.',
        'identify' => 'Идентифицира и чете публичния профил.',

        'chat' => [
            'write' => 'Изпраща съобщения от мое име.',
        ],

        'forum' => [
            'write' => 'Създава, редактира форумни теми и коментари от мое име.',
        ],

        'friends' => [
            'read' => 'Виж кого следите.',
        ],

        'public' => 'Четене на публични данни от ваше име.',
    ],
];
