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
        'bot' => 'Als Chat-Bot agieren.',
        'identify' => 'Dich identifizieren und dein öffentliches Profil lesen.',

        'chat' => [
            'read' => 'Nachrichten in deinem Namen lesen.',
            'write' => 'Nachrichten unter deinem Namen versenden.',
            'write_manage' => 'Betrete und verlasse Channel in deinem Namen.',
        ],

        'forum' => [
            'write' => 'Forenposts und Beiträge in deinem Namen erstellen und bearbeiten.',
            'write_manage' => 'Verwalte Forenbeiträge in deinem Namen.',
        ],

        'friends' => [
            'read' => 'Sehen, wem du folgst.',
        ],

        'multiplayer' => [
            'write_manage' => '',
        ],

        'public' => 'In deinem Namen öffentliche Daten auslesen.',
    ],
];
