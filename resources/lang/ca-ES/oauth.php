<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancel·lar',

    'authorise' => [
        'request' => 'està sol·licitant permís per accedir al vostre compte.',
        'scopes_title' => 'Aquesta aplicació serà capaç de:',
        'title' => 'Sol·licitud d\'autorització',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Esteu segur que voleu revocar els permisos d\'aquest client?',
        'scopes_title' => 'Aquesta aplicació pot:',
        'owned_by' => 'Propietat de :user',
        'none' => 'Cap client',

        'revoked' => [
            'false' => 'Revoca l\'accés',
            'true' => 'Accés denegat',
        ],
    ],

    'client' => [
        'id' => 'ID del client',
        'name' => 'Nom de l\'aplicació',
        'redirect' => 'URL de devolució de trucada de l\'aplicació',
        'reset' => 'Restablir secret de client',
        'reset_failed' => 'No s\'ha pogut restablir el secret de client',
        'secret' => 'Secret del client',

        'secret_visible' => [
            'false' => 'Mostra secret de client',
            'true' => 'Amaga el secret de client',
        ],
    ],

    'new_client' => [
        'header' => 'Registreu una nova aplicació OAuth',
        'register' => 'Registre de l\'aplicació',
        'terms_of_use' => [
            '_' => 'En utilitzar l\'API, vostè accepta els :link.',
            'link' => 'Condicions d\'ús',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Esteu segur que voleu suprimir aquest client?',
        'confirm_reset' => 'Esteu segur que voleu restablir el secret de client? Això revocarà tots els tokens existents.',
        'new' => 'Nova aplicació OAuth',
        'none' => 'Cap client',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminat',
        ],
    ],
];
