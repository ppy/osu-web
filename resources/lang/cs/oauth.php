<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Zrušit',

    'authorise' => [
        'app_owner' => 'aplikace od :owner',
        'request' => 'žádá o přístup k vašemu účtu.',
        'scopes_title' => 'Tato aplikace bude moci:',
        'title' => 'Žádost o autorizaci',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Jste si jisti, že chcete odstranit toto oprávnění?',
        'scopes_title' => 'Tato aplikace může:',
        'owned_by' => 'Vlastní :user',
        'none' => 'Žádní klienti',

        'revoked' => [
            'false' => 'Zrušit přístup',
            'true' => 'Přístup byl zrušen',
        ],
    ],

    'client' => [
        'id' => 'ID klienta',
        'name' => 'Název aplikace',
        'redirect' => 'URL adresy zpětného volání aplikace',
        'reset' => 'Resetovat tajný klíč klienta',
        'reset_failed' => 'Obnovení tajného klíče klienta se nezdařilo',
        'secret' => 'Tajný klíč klienta',

        'secret_visible' => [
            'false' => 'Zobrazit tajný klíč klienta',
            'true' => 'Skrýt tajný klíč klienta',
        ],
    ],

    'new_client' => [
        'header' => 'Registrovat novou OAuth aplikaci',
        'register' => 'Registrovat aplikaci',
        'terms_of_use' => [
            '_' => 'Používáním API souhlasíte s :link.',
            'link' => 'Smluvní podmínky',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Opravdu chcete odebrat tohoto klienta?',
        'confirm_reset' => 'Jste si jisti, že chcete resetovat klíč klienta? Tímto se zruší všechny existující tokeny.',
        'new' => 'Nová OAuth aplikace',
        'none' => 'Žádní klienti',

        'revoked' => [
            'false' => 'Smazat',
            'true' => 'Smazáno',
        ],
    ],
];
