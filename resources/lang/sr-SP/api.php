<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Не можете послати празну поруку.',
            'limit_exceeded' => 'Шаљете поруке превише брзо, молимо Вас сачекајте секунду и пробајте опет.',
            'too_long' => 'Порука коју желите послати је предугачка.',
        ],
    ],

    'scopes' => [
        'bot' => '',
        'identify' => 'Вас индентификује и прочита Ваш јавни профил.',

        'chat' => [
            'write' => '',
        ],

        'forum' => [
            'write' => '',
        ],

        'friends' => [
            'read' => 'Погледајте кога пратите.',
        ],

        'public' => 'Приступите јавним подацима у ваше име.',
    ],
];
