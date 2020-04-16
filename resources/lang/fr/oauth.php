<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Annuler',

    'authorise' => [
        'request' => 'demande la permission d\'accéder à votre compte.',
        'scopes_title' => 'Cette application pourra :',
        'title' => 'Demande d’autorisation',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Êtes-vous sûr de vouloir révoquer les permissions de ce client ?',
        'scopes_title' => 'Cette application peut :',
        'owned_by' => 'Crée par :user',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Révoquer l\'accès',
            'true' => 'Accès révoqué',
        ],
    ],

    'client' => [
        'id' => 'ID du client',
        'name' => 'Nom de l\'application',
        'redirect' => 'URL de retour de l\'application',
        'reset' => '',
        'reset_failed' => '',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => '',
            'true' => '',
        ],
    ],

    'new_client' => [
        'header' => 'Inscrire une nouvelle application OAuth',
        'register' => 'Inscrire une application',
        'terms_of_use' => [
            '_' => 'En utilisant cette API vous acceptez :link.',
            'link' => 'Termes d\'utilisation',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer ce client ?',
        'confirm_reset' => '',
        'new' => 'Nouvelle application OAuth',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Supprimer',
            'true' => 'Supprimé',
        ],
    ],
];
