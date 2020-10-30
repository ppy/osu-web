<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Du kannst keine leeren Nachrichten senden.',
            'limit_exceeded' => 'Du sendest zu viele Nachrichten! Bitte warte kurz, bevor du es erneut versuchst.',
            'too_long' => 'Die Nachricht, die du versuchst zu senden, ist zu lang.',
        ],
    ],

    'scopes' => [
        'identify' => 'Dich identifizieren und dein öffentliches Profil lesen.',

        'friends' => [
            'read' => 'Sehen, wem du folgst.',
        ],

        'public' => 'In deinem Namen öffentliche Daten auslesen.',
    ],
];
