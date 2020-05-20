<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Avbryt',

    'authorise' => [
        'request' => 'ber om tilgang til kontoen din.',
        'scopes_title' => 'Dette programmet vil kunne:',
        'title' => 'Forespørsel om godkjenning',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Er su dikker på at du vil oppheve tillatelsen til denne klienten?',
        'scopes_title' => 'Denne applikasjonen kan:',
        'owned_by' => 'Eies av :user',
        'none' => 'Ingen autoriserte applikasjoner',

        'revoked' => [
            'false' => 'Opphev tilgang',
            'true' => 'Tilgang opphevet',
        ],
    ],

    'client' => [
        'id' => 'Klient-ID',
        'name' => 'Applikasjonsnavn',
        'redirect' => 'Applikasjonens omdirigeringslenke',
        'reset' => 'Nullstille klienthemmelighet',
        'reset_failed' => 'Kunne ikke nullstille klienthemmelighet',
        'secret' => 'Kundehemmelighet',

        'secret_visible' => [
            'false' => 'Vis klienthemmelighet',
            'true' => 'Skjul klienthemmelighet',
        ],
    ],

    'new_client' => [
        'header' => 'Registrer en ny OAuth-applikasjon',
        'register' => 'Registrer applikasjon',
        'terms_of_use' => [
            '_' => 'Med å bruke API-en godtar du :link.',
            'link' => 'Brukervilkår',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Er du sikker på at du vil slette denne klienten?',
        'confirm_reset' => 'Er du sikker på at du vil nullstille klienthemmeligheten? Dette vil tilbakekalle alle eksisterende tokens.',
        'new' => 'Ny OAuth applikasjon',
        'none' => 'Ingen Klienter',

        'revoked' => [
            'false' => 'Slett',
            'true' => 'Slettet',
        ],
    ],
];
