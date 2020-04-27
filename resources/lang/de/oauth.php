<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Abbrechen',

    'authorise' => [
        'request' => 'fordert die Berechtigung, auf Ihr Konto zuzugreifen.',
        'scopes_title' => 'Diese Anwendung wird in der Lage sein:',
        'title' => 'Autorisierungsanfrage',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Bist du sicher, dass du die Berechtigungen dieses Gerätes widerrufen möchtest?',
        'scopes_title' => 'Diese Anwendung kann:',
        'owned_by' => 'Gehört :user',
        'none' => 'Keine Geräte',

        'revoked' => [
            'false' => 'Zugriff widerrufen',
            'true' => 'Zugriff entfernt',
        ],
    ],

    'client' => [
        'id' => 'Client-ID',
        'name' => 'Anwendungsname',
        'redirect' => 'Anwendungs-Callback-URL',
        'reset' => 'Client-Geheimnis resetten',
        'reset_failed' => 'Client-Geheimnis könnte nicht reset werden',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Client-Geheimnis zeigen',
            'true' => 'Client-Geheimnis verstecken',
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
        'confirm_delete' => 'Bist du sicher, dass du dieses Gerät löschen willst?',
        'confirm_reset' => 'Möchten Sie das Client-Geheimnis wirklich zurücksetzen? Dadurch werden alle vorhandenen Wertmarken widerrufen.',
        'new' => 'Neue OAuth-Anwendung',
        'none' => 'Keine Geräte',

        'revoked' => [
            'false' => 'Löschen',
            'true' => 'Gelöscht',
        ],
    ],
];
