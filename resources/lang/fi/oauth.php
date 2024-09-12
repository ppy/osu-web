<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Peruuta',

    'authorise' => [
        'app_owner' => 'sovellus käyttäjältä: :owner',
        'request' => 'pyytää lupaa yhdistää tilillesi.',
        'scopes_title' => 'Tämä sovellus voi:',
        'title' => 'Yhdistyspyyntö',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Oletko varma, että haluat peruuttaa tämän käyttäjän valtuudet?',
        'scopes_title' => 'Tämä sovellus voi:',
        'owned_by' => 'Omistaa :user',
        'none' => 'Ei clienttejä',

        'revoked' => [
            'false' => 'Kumoa käyttöoikeudet',
            'true' => 'Pääsy Peruutettu',
        ],
    ],

    'client' => [
        'id' => 'Clientin ID',
        'name' => 'Sovelluksen Nimi',
        'redirect' => 'Sovelluksen Takaisinsoitto URL:t',
        'reset' => 'Nollaa clientin salaisuus',
        'reset_failed' => 'Clientin salaisuuden nollaaminen epäonnistui',
        'secret' => 'Clientin salaisuus',

        'secret_visible' => [
            'false' => 'Näytä clientin salaisuus',
            'true' => 'Piilota clientin salaisuus',
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
        'confirm_delete' => 'Haluatko varmasti poistaa tämän clientin?',
        'confirm_reset' => 'Haluatko varmasti nollata clientin salaisuuden? Tämä kumoaa kaikki olemassa olevat tokenit.',
        'new' => 'Uusi OAuth-sovellus',
        'none' => 'Ei asiakasohjelmia',

        'revoked' => [
            'false' => 'Poista',
            'true' => 'Poistettu',
        ],
    ],
];
