<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Mégse',

    'authorise' => [
        'request' => 'engedélyt kér a fiókodhoz.',
        'scopes_title' => 'Ez az alkalmazás képes lesz a:',
        'title' => 'Hitelesítési Kérelem',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Biztosan vissza akarod vonni ezen kliens jogait?',
        'scopes_title' => 'Az alkalmazás képes:',
        'owned_by' => ':user tulajdona',
        'none' => 'Nincsnek kliensek',

        'revoked' => [
            'false' => 'Hozzáférés visszavonása',
            'true' => 'Hozzáférés visszavonva',
        ],
    ],

    'client' => [
        'id' => 'Kliens ID',
        'name' => 'Alkalmazás neve',
        'redirect' => 'Az alkalmazás URL-je',
        'reset' => 'Ügyfél titkosításának visszavonása',
        'reset_failed' => 'Az ügyfél titkosításának visszavonása sikertelen',
        'secret' => 'Ügyfél titkos kódja',

        'secret_visible' => [
            'false' => 'Ügyfél titkosított adatai mutatása',
            'true' => 'Ügyfél titkosítása',
        ],
    ],

    'new_client' => [
        'header' => 'Regisztálj egy új OAuth alkalmazást',
        'register' => 'Regisztráld az alkalmazásodat',
        'terms_of_use' => [
            '_' => 'Ha az API-t használod, elfogadod a :link feltételeit.',
            'link' => 'Felhasználási feltételek',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Biztos vagy benne, hogy törlöd ezt a klienst?',
        'confirm_reset' => 'Biztos vagy benne, hogy törlöd az ügyfél titkositását? Ez az összes tokent eltávolitja.',
        'new' => 'Új OAuth alkalmazás',
        'none' => 'Nincs Kliens',

        'revoked' => [
            'false' => 'Törlés',
            'true' => 'Törölve',
        ],
    ],
];
