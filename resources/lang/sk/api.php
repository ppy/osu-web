<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nemôžete poslať prázdnu správu.',
            'limit_exceeded' => 'Posielate správy príliš rýchlo, prosím, počkajte chvíľu než to skúsite znova.',
            'too_long' => 'Správa, ktorú sa snažíte poslať, je príliš dlhá.',
        ],
    ],

    'scopes' => [
        'bot' => 'Správať sa ako chat bot.',
        'identify' => 'Identifikovať vás a prezerať váš verejný profil.',

        'chat' => [
            'read' => 'Prečítajte si správy vo vašom mene.
',
            'write' => 'Posielajte správy vo vašom mene.',
            'write_manage' => 'Pripojte sa a opustite kanály vo vašom mene.',
        ],

        'forum' => [
            'write' => 'Vytvárajte a upravujte témy a príspevky fóra vo vašom mene.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Pozrieť koho sledujete.',
        ],

        'multiplayer' => [
            'write_manage' => '',
        ],

        'public' => 'Čítajte verejné údaje vo vašom mene.',
    ],
];
