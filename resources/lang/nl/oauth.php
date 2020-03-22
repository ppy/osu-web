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
        'secret' => 'Client Secret',
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
        'new' => 'Nieuwe OAuth applicatie',
        'none' => 'Geen clients',

        'revoked' => [
            'false' => 'Verwijderen',
            'true' => 'Verwijderd',
        ],
    ],
];
