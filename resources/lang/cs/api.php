<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nelze odeslat prázdnou zprávu.',
            'limit_exceeded' => 'Posíláte zprávy moc rychle, vyčkejte prosím chvíli a zkuste to znovu.',
            'too_long' => 'Zpráva, kterou se snažíte poslat, je moc dlouhá.',
        ],
    ],

    'scopes' => [
        'bot' => 'Chovat se jako chat bot.',
        'identify' => 'Indentifikovat vás a prohlížet váš veřejný profil.',

        'chat' => [
            'write' => 'Posílejte zprávy vaším jménem.',
        ],

        'forum' => [
            'write' => 'Vytvořte a upravujte témata fóra a příspěvky vaším jménem.',
        ],

        'friends' => [
            'read' => 'Vidět, koho sledujete.',
        ],

        'public' => 'Číst veřejná data vaším jménem.',
    ],
];
