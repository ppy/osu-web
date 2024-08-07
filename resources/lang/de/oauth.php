<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Abbrechen',

    'authorise' => [
        'app_owner' => 'eine App von :owner',
        'request' => 'bittet um Erlaubnis, auf dein Konto zugreifen zu dürfen.',
        'scopes_title' => 'Diese Anwendung wird in der Lage sein:',
        'title' => 'Autorisierungsanfrage',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Bist du sicher, dass du die Berechtigungen dieser Anwendung widerrufen möchtest?',
        'scopes_title' => 'Diese Anwendung kann:',
        'owned_by' => 'Gehört :user',
        'none' => 'Keine Anwendungen',

        'revoked' => [
            'false' => 'Zugriff widerrufen',
            'true' => 'Zugriff entfernt',
        ],
    ],

    'client' => [
        'id' => 'Client-ID',
        'name' => 'Anwendungsname',
        'redirect' => 'Anwendungs-Callback-URLs',
        'reset' => 'Client-Secret zurücksetzen',
        'reset_failed' => 'Client-Secret konnte nicht zurückgesetzt werden',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Client-Secret zeigen',
            'true' => 'Client-Secret verbergen',
        ],
    ],

    'new_client' => [
        'header' => 'Neue OAuth-Anwendung registrieren',
        'register' => 'Anwendung registrieren',
        'terms_of_use' => [
            '_' => 'Durch die Nutzung der API stimmst du den :link zu.',
            'link' => 'Nutzungsbedingungen',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Bist du sicher, dass du diese Anwendung entfernen willst?',
        'confirm_reset' => 'Möchtest du das Client-Secret wirklich zurücksetzen? Dadurch werden alle vorhandenen Tokens widerrufen.',
        'new' => 'Neue OAuth-Anwendung',
        'none' => 'Keine Anwendungen',

        'revoked' => [
            'false' => 'Löschen',
            'true' => 'Gelöscht',
        ],
    ],
];
