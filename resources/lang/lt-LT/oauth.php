<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Atšaukti',

    'authorise' => [
        'request' => 'prašo priėjimo prie jūsų paskyros.',
        'scopes_title' => 'Ši aplikacija galės:',
        'title' => 'Įgaliojimo Prašymas',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Ar jus užtikrintas, kad norite panaikinti šio kliento leidimus?',
        'scopes_title' => 'Ši aplikacija gali:',
        'owned_by' => 'Priklauso :user',
        'none' => 'Nėra Klientų',

        'revoked' => [
            'false' => 'Atšaukti Prieigą',
            'true' => 'Prieiga Atšaukta',
        ],
    ],

    'client' => [
        'id' => 'Kliento ID',
        'name' => 'Aplikacijos Pavadinimas',
        'redirect' => 'Aplikacijos Atgalinio susisiekimo URL',
        'reset' => 'Atstatyti kliento raktą',
        'reset_failed' => 'Nepavyko atstatyti kliento rakto',
        'secret' => 'Kliento Raktas',

        'secret_visible' => [
            'false' => 'Rodyti kliento raktą',
            'true' => 'Slėpti kliento raktą',
        ],
    ],

    'new_client' => [
        'header' => 'Registruoti naują OAuth aplikaciją',
        'register' => 'Registruoti aplikaciją',
        'terms_of_use' => [
            '_' => 'Naudodami API jūs sutinkate su :link.',
            'link' => 'Naudojimosi Sąlygomis',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Ar tikrai norite pašalinti šį klientą?',
        'confirm_reset' => 'Ar jūs užtikrinti, kad norite atstatyti kliento raktą? Tai pašalins visas esamas atminas.',
        'new' => 'Nauja OAuth Aplikacija',
        'none' => 'Nėra Klientų',

        'revoked' => [
            'false' => 'Ištrinti',
            'true' => 'Ištrintas',
        ],
    ],
];
