<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
        'secret' => 'Client Secret',
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
        'new' => 'Neue OAuth-Anwendung',
        'none' => 'Keine Geräte',

        'revoked' => [
            'false' => 'Löschen',
            'true' => 'Gelöscht',
        ],
    ],
];
