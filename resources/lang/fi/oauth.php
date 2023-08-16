<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Peruuta',

    'authorise' => [
        'request' => 'pyytää lupaa yhdistää tilillesi.',
        'scopes_title' => 'Tämä sovellus voi:',
        'title' => 'Yhdistyspyyntö',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Oletko varma, että haluat peruuttaa tämän käyttäjän valtuudet?',
        'scopes_title' => 'Tämä sovellus voi:',
        'owned_by' => 'Omistaa :user',
        'none' => '',

        'revoked' => [
            'false' => 'Kumoa käyttöoikeudet',
            'true' => 'Pääsy Peruutettu',
        ],
    ],

    'client' => [
        'id' => '',
        'name' => 'Sovelluksen Nimi',
        'redirect' => 'Sovelluksen Takaisinsoitto URL:t',
        'reset' => '',
        'reset_failed' => '',
        'secret' => '',

        'secret_visible' => [
            'false' => '',
            'true' => '',
        ],
    ],

    'new_client' => [
        'header' => 'Rekisteröi uusi OAuth-sovellus',
        'register' => 'Rekisteröi uusi sovellus',
        'terms_of_use' => [
            '_' => 'Käyttämällä rajapintaa hyväksyt :link.',
            'link' => 'Käyttöehdot',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '',
        'confirm_reset' => '',
        'new' => 'Uusi OAuth-Sovellus',
        'none' => '',

        'revoked' => [
            'false' => 'Poista',
            'true' => 'Poistettu',
        ],
    ],
];
