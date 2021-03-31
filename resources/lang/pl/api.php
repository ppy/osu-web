<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nie możesz wysłać pustej wiadomości.',
            'limit_exceeded' => 'Wysyłasz wiadomości zbyt szybko, poczekaj chwilę zanim zaczniesz wysyłać kolejne.',
            'too_long' => 'Wiadomość, którą chcesz wysłać, jest zbyt długa.',
        ],
    ],

    'scopes' => [
        'bot' => 'działać jako chatbot',
        'identify' => 'zidentyfikować cię i uzyskać publiczne informacje z twojego profilu.',

        'chat' => [
            'write' => 'wysyłać wiadomości w twoim imieniu',
        ],

        'forum' => [
            'write' => 'tworzyć i edytować posty oraz wątki na forum w twoim imieniu',
        ],

        'friends' => [
            'read' => 'zobaczyć, kogo obserwujesz.',
        ],

        'public' => 'odczytywać dane publiczne w twoim imieniu',
    ],
];
