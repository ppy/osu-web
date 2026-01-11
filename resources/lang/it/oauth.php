<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Annulla',

    'authorise' => [
        'app_owner' => 'un\'applicazione di :owner',
        'request' => 'sta richiedendo l\'autorizzazione di accedere al tuo account.',
        'scopes_title' => 'Questa applicazione sarà in grado di:',
        'title' => 'Richiesta di autorizzazione',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Sei sicuro di voler revocare i permessi di questo client?',
        'scopes_title' => 'Questa applicazione può:',
        'owned_by' => 'Di :user',
        'none' => 'Nessun client',

        'revoked' => [
            'false' => 'Revoca Accesso',
            'true' => 'Accesso Revocato',
        ],
    ],

    'client' => [
        'id' => 'Client ID',
        'name' => 'Nome applicazione',
        'redirect' => 'URL di callback dell\'applicazione (uno o più)',
        'reset' => 'Resetta il client secret',
        'reset_failed' => 'Impossibile resettare il client secret',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Mostra il client secret',
            'true' => 'Nascondi il client secret',
        ],
    ],

    'new_client' => [
        'header' => 'Registra una nuova applicazione OAuth',
        'register' => 'Registra applicazione',
        'terms_of_use' => [
            '_' => 'Utilizzando l\'API accetti le :link.',
            'link' => 'Condizioni di Utilizzo',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Sei sicuro di voler eliminare questo client?',
        'confirm_reset' => 'Sei sicuro di voler resettare il client secret? Questo revocherà tutti i token esistenti.',
        'new' => 'Nuova applicazione OAuth',
        'none' => 'Nessun client',

        'revoked' => [
            'false' => 'Elimina',
            'true' => 'Eliminato',
        ],
    ],
];
