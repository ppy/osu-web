<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Hindi makapagpadala ng blangkong mensahe.',
            'limit_exceeded' => 'Masyadong mabilis ang iyong pagpapadala ng mensahe, maghintay lamang ng kaunti bago muling subukan.',
            'too_long' => 'Masyadong mahaba ang pinapadala mong mensahe.',
        ],
    ],

    'scopes' => [
        'bot' => 'Gumanap bilang isang chat bot.',
        'identify' => 'Tukuyin ka at basahin ang iyong pampublikong profile.',

        'chat' => [
            'read' => 'Basahin ang mga mensahe sa iyong ngalan.',
            'write' => 'Magpadala ng mga mensahe sa iyong ngalan.',
            'write_manage' => 'Sumali at umalis sa mga channel sa ngalan mo.',
        ],

        'forum' => [
            'write' => 'Gumuwa at mag-edit ng mga paksa at mga post ng forum sa iyong ngalan.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Tignan kung sino ang iyong mga sinusundan.',
        ],

        'multiplayer' => [
            'write_manage' => '',
        ],

        'public' => 'Magbasa ng pampublikong data sa iyong ngalan.',
    ],
];
