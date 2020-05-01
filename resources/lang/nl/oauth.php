<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Annuleren',

    'authorise' => [
        'request' => 'vraagt om toestemming om toegang tot uw account.',
        'scopes_title' => 'Deze applicatie krijgt toegang tot:',
        'title' => 'Inloggen verplicht',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Weet u zeker dat u de rechten van deze client wilt intrekken?',
        'scopes_title' => 'Deze applicatie kan:',
        'owned_by' => 'Eigendom van :user',
        'none' => 'Geen clients',

        'revoked' => [
            'false' => 'Toegang intrekken',
            'true' => 'Toegang Ingetrokken',
        ],
    ],

    'client' => [
        'id' => 'Client-ID',
        'name' => 'Applicatienaam',
        'redirect' => 'Applicatie Terugbel URL',
        'reset' => 'Reset client geheim',
        'reset_failed' => 'Resetten van client geheim mislukt',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Laat client geheim zien',
            'true' => 'Verberg client geheim',
        ],
    ],

    'new_client' => [
        'header' => 'Registreer een nieuwe OAuth applicatie',
        'register' => 'Registreer applicatie',
        'terms_of_use' => [
            '_' => 'Door gebruik te maken van de API gaat u akkoord met de :link.',
            'link' => 'Gebruiksvoorwaarden',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Weet je zeker dat je deze reactie wilt verwijderen?',
        'confirm_reset' => 'Weet je zeker dat je jouw client geheim wilt resetten? Dit verwijdert alle huidige kentekens.',
        'new' => 'Nieuwe OAuth applicatie',
        'none' => 'Geen clients',

        'revoked' => [
            'false' => 'Verwijderen',
            'true' => 'Verwijderd',
        ],
    ],
];
