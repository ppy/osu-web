<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Anulează',

    'authorise' => [
        'request' => 'solicită permisiunea de a-ţi accesa contul.',
        'scopes_title' => 'Această aplicaţie va putea să:',
        'title' => 'Cerere de autorizare',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Ești sigur(ă) că vrei să revocați permisiunile clientului?',
        'scopes_title' => 'Această aplicație poate:',
        'owned_by' => 'Deținut de :user',
        'none' => 'Niciun Client',

        'revoked' => [
            'false' => 'Revocă Accesul',
            'true' => 'Acces revocat',
        ],
    ],

    'client' => [
        'id' => 'ID-ul clientului',
        'name' => 'Numele Aplicației',
        'redirect' => 'URL-ul Callback al Aplicației',
        'reset' => 'Resetează client secret',
        'reset_failed' => 'Nu s-a putut reseta client secret',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Arată clientul secret',
            'true' => 'Ascunde clientul secret',
        ],
    ],

    'new_client' => [
        'header' => 'Înregistrează o nouă aplicație OAuth',
        'register' => 'Înregistrează aplicația',
        'terms_of_use' => [
            '_' => 'Folosind API-ul sunteți de acord cu :link.',
            'link' => 'Termeni de Utilizare',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Ești sigur(Ă) că vrei să ștergi acest client?',
        'confirm_reset' => 'Ești sigur(Ă) că vrei să resetezi clientul secret? Acesta va revoca toate token-urile existente.',
        'new' => 'Noi aplicații OAuth',
        'none' => 'Niciun Client',

        'revoked' => [
            'false' => 'Șterge',
            'true' => 'Șters',
        ],
    ],
];
