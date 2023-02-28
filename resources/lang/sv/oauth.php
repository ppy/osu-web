<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Avbryt',

    'authorise' => [
        'request' => 'begär behörighet att komma åt ditt konto.',
        'scopes_title' => 'Denna applikation kommer att kunna:',
        'title' => 'Auktoriseringsbegäran.',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Är du säker på att du vill återkalla denna klients behörigheter?',
        'scopes_title' => 'Den här applikationen kan:',
        'owned_by' => 'Ägs av :user',
        'none' => 'Inga klienter',

        'revoked' => [
            'false' => 'Återkalla åtkomst',
            'true' => 'Åtkomst återkallats',
        ],
    ],

    'client' => [
        'id' => 'Klient-ID',
        'name' => 'Applikationsnamn',
        'redirect' => 'URL för appens callback',
        'reset' => 'Återställ klienthemligheten',
        'reset_failed' => 'Kunde inte återställa klienthemligheten',
        'secret' => 'Klienthemlighet',

        'secret_visible' => [
            'false' => 'Visa klienthemligheten',
            'true' => 'Göm klienthemligheten',
        ],
    ],

    'new_client' => [
        'header' => 'Registrera en ny OAuth-applikation',
        'register' => 'Registrera applikationen',
        'terms_of_use' => [
            '_' => 'Genom att använda denna API godkänner du :link.',
            'link' => 'Användarvillkor',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Är du säker på att du vill radera denna klient?',
        'confirm_reset' => 'Är du säker på att du vill återställa klienthemligheten? Detta kommer att återkalla alla befintliga tokens.',
        'new' => 'Ny OAuth-applikation ',
        'none' => 'Inga klienter',

        'revoked' => [
            'false' => 'Radera',
            'true' => 'Raderad',
        ],
    ],
];
