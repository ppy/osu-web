<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'create' => [
        'finish' => 'Abschließen',
        'key' => 'Scanne den QR-Code mit der Authentifizierungs-App und gib die PIN ein',
        'key_copy' => 'Oder klicke diesen Link, um den Schlüssel für die Authentifizierungs-App zu kopieren',
        'key_link' => 'Verwende diesen Link, wenn du ein Mobiltelefon nutzt',
        'password' => 'Bitte gib dein aktuelles Passwort ein, um die Zwei-Faktor-Authentifizierung einzurichten',
        'start' => 'Weiter',
    ],

    'destroy' => [
        'missing' => 'Die Zwei-Faktor-Authentifizierung wurde noch nicht eingerichtet.',
        'ok' => 'Die Zwei-Faktor-Authentifizierung wurde deaktiviert.',
    ],

    'edit' => [
        'password' => 'Bitte gib dein aktuelles Passwort ein, um die Zwei-Faktor-Authentifizierung zu deaktivieren.',
        'start' => 'Deaktivieren',
    ],

    'store' => [
        'existing' => 'Die Zwei-Faktor-Authentifizierung ist bereits aktiviert.',
        'ok' => 'Die Zwei-Faktor-Authentifizierung wurde aktiviert.',
        'restart' => 'Fehler aufgetreten. Bitte starte den Prozess neu.',
    ],
];
