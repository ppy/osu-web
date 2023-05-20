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
        'bot' => 'Понашајте се као чет бот.',
        'identify' => 'Да вас идентификује и да прочита ваш јавни профил.',

        'chat' => [
            'write' => 'Шаљите поруке у ваше име.',
        ],

        'forum' => [
            'write' => 'Правите и мењајте форум теме и објаве у ваше име.',
        ],

        'friends' => [
            'read' => 'Погледајте кога пратите.',
        ],

        'public' => 'Приступите јавним подацима у ваше име.',
    ],
];
