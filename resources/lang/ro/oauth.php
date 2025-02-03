<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Anulează',

    'authorise' => [
        'app_owner' => 'o aplicație realizată de :owner',
        'request' => 'solicită permisiunea de a-ţi accesa contul.',
        'scopes_title' => 'Această aplicaţie va putea să:',
        'title' => 'Cerere de autorizare',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Ești sigur că dorești revocarea permisiunilor clientului?',
        'scopes_title' => 'Această aplicație poate:',
        'owned_by' => 'Deținut de :user',
        'none' => 'Niciun Client',

        'revoked' => [
            'false' => 'Revocă Accesul',
            'true' => 'Acces revocat',
        ],
    ],

    'client' => [
        'id' => 'ID-ul client-ului',
        'name' => 'Numele Aplicației',
        'redirect' => 'URL-ul Callback al Aplicației',
        'reset' => 'Resetează secretul clientului',
        'reset_failed' => 'Resetarea secretului clientului a eșuat',
        'secret' => 'Secret Client',

        'secret_visible' => [
            'false' => 'Afișează secretul clientului',
            'true' => 'Ascunde secretul clientului',
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
        'confirm_delete' => '
Ești sigur că dorești să ștergi acest client?',
        'confirm_reset' => 'Ești sigur că dorești să resetezi secretul clientului? Se vor revoca toate token-urile existente.',
        'new' => 'Aplicație OAuth nouă',
        'none' => 'Niciun Client',

        'revoked' => [
            'false' => 'Șterge',
            'true' => 'Șters',
        ],
    ],
];
