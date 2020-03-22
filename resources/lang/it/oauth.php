<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'cancel' => 'Annulla',

    'authorise' => [
        'request' => 'sta richiedendo l\'autorizzazione di accedere al tuo account.',
        'scopes_title' => 'Questa applicazione sarà in grado di:',
        'title' => 'Richiesta di autorizzazione',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Sei sicuro di voler revocare i permessi di questo client?',
        'scopes_title' => 'Questa applicazione può:',
        'owned_by' => 'Di :user',
        'none' => 'Nessun Client',

        'revoked' => [
            'false' => 'Revoca Accesso',
            'true' => 'Accesso Revocato',
        ],
    ],

    'client' => [
        'id' => 'Client ID',
        'name' => 'Nome Applicazione',
        'redirect' => 'URL di richiamo dell\'applicazione',
        'secret' => 'Client Secret',
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
        'new' => 'Nuova Applicazione OAuth',
        'none' => 'Nessun Client',

        'revoked' => [
            'false' => 'Elimina',
            'true' => 'Eliminato',
        ],
    ],
];
