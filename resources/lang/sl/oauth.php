<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Prekliči',

    'authorise' => [
        'request' => 'želi dovoljenje za dostop do tvojega računa.',
        'scopes_title' => 'Ta aplikacija bo lahko:',
        'title' => 'Avtorizacijska zahteva',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Ali si prepričan, da želiš razveljaviti dovoljenja tega client-a?',
        'scopes_title' => 'Ta aplikacija lahko:',
        'owned_by' => 'V lasti :user',
        'none' => 'Ni client-ov',

        'revoked' => [
            'false' => 'Razveljavi dostop',
            'true' => 'Dostop razveljavljen',
        ],
    ],

    'client' => [
        'id' => 'Client ID',
        'name' => 'Ime aplikacije',
        'redirect' => 'Callback URL aplikacije',
        'reset' => 'Ponastavi kodo client-a',
        'reset_failed' => 'Ponastavitev kode client-a neuspešna',
        'secret' => 'Koda client-a',

        'secret_visible' => [
            'false' => 'Prikaži kodo client-a',
            'true' => 'Skrij kodo client-a',
        ],
    ],

    'new_client' => [
        'header' => 'Registriraj novo OAuth aplikacijo',
        'register' => 'Registriraj aplikacijo',
        'terms_of_use' => [
            '_' => 'Z uporabo API se strinjaš s :link.',
            'link' => 'Pogoji uporabe',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Ali si prepričan, da želiš odstraniti ta client?',
        'confirm_reset' => 'Ali si prepričan, da želiš ponastaviti kodo client-a? To bo razveljavilo vse obstoječe kode.',
        'new' => 'Nova OAuth aplikacija',
        'none' => 'Ni client-ov',

        'revoked' => [
            'false' => 'Odstrani',
            'true' => 'Odstranjeno',
        ],
    ],
];
