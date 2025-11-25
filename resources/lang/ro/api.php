<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nu se pot trimite mesaje goale.',
            'limit_exceeded' => 'Trimiți mesaje prea repede, te rugăm să aștepți puțin înainte de a trimite unul nou.',
            'too_long' => 'Mesajul pe care dorești să-l trimiți este prea lung.',
        ],
    ],

    'scopes' => [
        'bot' => 'Să acționeze ca un chat bot.',
        'identify' => 'Să te identifice și să-ți citească profilul public.',

        'chat' => [
            'read' => 'Să citească mesaje în numele tău.',
            'write' => 'Să trimită mesaje în numele tău.',
            'write_manage' => 'Să părăsească și să se alăture la canale text în numele tău.',
        ],

        'forum' => [
            'write' => 'Să creeze și editeze subiecte și postări din forum în numele tău.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Să vadă pe cine urmărești.',
        ],

        'public' => 'Să citească date publice în numele tău.',
    ],
];
