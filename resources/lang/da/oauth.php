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
    'cancel' => 'Annuller',

    'authorise' => [
        'request' => 'anmoder om tilladelse til at få adgang til din konto.',
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
        'secret' => 'Client Secret',
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
        'new' => 'Ny OAuth Applikation',
        'none' => 'Ingen Klienter',

        'revoked' => [
            'false' => 'Fjern',
            'true' => 'Slettet',
        ],
    ],
];
