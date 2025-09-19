<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Poništi',

    'authorise' => [
        'app_owner' => '',
        'request' => 'traži dopuštenje za pristup tvom računu.',
        'scopes_title' => 'Ova aplikacija će moći:',
        'title' => 'Zahtjev za autorizaciju',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Jesi li siguran da želiš ukinuti dopuštenja ovog klijenta?',
        'scopes_title' => 'Ova aplikacija može:',
        'owned_by' => 'Napravio :user',
        'none' => 'Nema klijenata',

        'revoked' => [
            'false' => 'Ukini pristup',
            'true' => 'Pristup ukinut',
        ],
    ],

    'client' => [
        'id' => 'ID klijenta',
        'name' => 'Ime aplikacije',
        'redirect' => 'Callback URL aplikacije',
        'reset' => 'Resetiraj Client Secret',
        'reset_failed' => 'Resetiranje client secreta nije uspjelo',
        'secret' => 'Secret klijenta',

        'secret_visible' => [
            'false' => 'Pokaži secret klijenta',
            'true' => 'Sakrij secret klijenta',
        ],
    ],

    'new_client' => [
        'header' => 'Registriraj novu OAuth aplikaciju',
        'register' => 'Registriraj aplikaciju',
        'terms_of_use' => [
            '_' => 'Korištenjem API-ja pristaješ na :link.',
            'link' => 'Uvjete korištenja',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Jesi li siguran da želiš obrisati ovog klijenta?',
        'confirm_reset' => 'Jesi li siguran da želiš resetirati secret klijenta? Ovo će ukinuti sve postojeće tokene.',
        'new' => 'Nova OAuth aplikacija',
        'none' => 'Nema klijenata',

        'revoked' => [
            'false' => 'Izbriši',
            'true' => 'Izbrisano',
        ],
    ],
];
