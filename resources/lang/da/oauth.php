<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Annullér',

    'authorise' => [
        'request' => 'anmoder om adgang til din konto.',
        'scopes_title' => 'Denne applikation vil være i stand til at:',
        'title' => 'Autorisation Anmodning',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Er du sikker på, at du vil tilbagekalde denne klients tilladelser?',
        'scopes_title' => 'Denne applikation kan:',
        'owned_by' => 'Ejet af :user',
        'none' => 'Ingen Klienter',

        'revoked' => [
            'false' => 'Fjern Adgang',
            'true' => 'Adgang Omstødt',
        ],
    ],

    'client' => [
        'id' => 'Klient-ID',
        'name' => 'Applikationsnavn',
        'redirect' => 'Application Callback URL',
        'reset' => 'Nulstil klient hemmeligheden',
        'reset_failed' => 'Kunne ikke nulstille klient hemmeligheden',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Vis klient hemmeligheden',
            'true' => 'Skjul klient hemmeligheden',
        ],
    ],

    'new_client' => [
        'header' => 'Registrer ny OAuth applikation',
        'register' => 'Registrer ny applikation',
        'terms_of_use' => [
            '_' => 'Ved at bruge denne API giver du samtykke til :link.',
            'link' => 'Brugsbetingelser',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Er du sikker på du vil slette denne klient?',
        'confirm_reset' => '
Er du sikker på, at du vil nulstille klienthemmeligheden? Dette vil fjerne alle eksisterende tokens.',
        'new' => 'Ny OAuth Applikation',
        'none' => 'Ingen Klienter',

        'revoked' => [
            'false' => 'Fjern',
            'true' => 'Slettet',
        ],
    ],
];
